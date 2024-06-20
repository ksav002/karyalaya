//loads questions using fetch_question within the right container of assignment page
function loadQuestion(assignmentCategoryId,teacherCoursesId){
    $('#category-id').val(assignmentCategoryId);
    $('#teacher-courses-id').val(teacherCoursesId);
    $.ajax({
        type: "POST", // Use POST as the method
        url: "fetch_questions.php", // The URL to send the request to
        data: {categoryId: assignmentCategoryId, teacherCoursesId: teacherCoursesId}, // Data to send in the request
        success: function(response) {
            // On success, update the .right element's HTML with the response
            $(".right").html(response);
            loadAccordion(); // Call loadAccordion here
            
        },
        error: function(xhr, status, error) {
            // Optionally handle errors
            console.log("Error: " + error);
        }
    });
}

//nav bar ma time dekhauna lai
function updateTime() {
    const now = new Date();
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const ampm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = hours % 12 || 12;
    const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
    const timeString = formattedHours + ':' + formattedMinutes + ' ' + ampm;

    const day = now.getDate();
    const month = now.getMonth() + 1; // Months start from zero so add 1
    const year = now.getFullYear();
    const formattedDay = day < 10 ? '0' + day : day;
    const formattedMonth = month < 10 ? '0' + month : month;
    const dateString = year + '-' + formattedMonth  + '-' + formattedDay;

    document.getElementById('nav-clock').textContent = timeString;
    document.getElementById('nav-date').textContent = dateString;
}

//kun category select vairako xa tyo tha pauna lai
function keepSelected(){
    $(document).ready(function(){
        $('.category-name').click(function(){
            // second time arko class name click garda agadi select gareko hatauna lai
            $('.category-name').removeClass('selected-category');
            // Add 'selected-category' class to the clicked category name
            $(this).addClass('selected-category');
        });
    });
}

function loadAccordion() {
    $(document).ready(function() {
        // Initially hide the question and preview part (and the buttons for both teacher and student)
        $('.assignment-title .question').hide();
        $('.hidden-button').hide();

        // Show the content of whichever clicked
        $('.assignment-title .title-name').click(function() {
            var $assignmentTitle = $(this).closest('.assignment-title'); // selects the closest ancestor
            var $question = $assignmentTitle.find('.question'); // selects the question related to that title
            var assignmentId = $assignmentTitle.data('assignment-id'); // Retrieve assignment id which is set in data-assignment-id

            // Expand or collapse this (selected) panel
            $question.slideToggle('slow', function() {
                // After toggle, check if this question is visible
                var isVisible = $question.is(':visible');
                $('.buttons .hidden-button').toggle(isVisible);

                // If the question is visible, set the assignment ID in the form hidden field for viewing submissions and submitting file
                $('#assignment-id').val(assignmentId); 
            });

            // Hide the other panels
            $(".assignment-title .question").not($question).slideUp('slow');
        });
    });
}


function validateCreateCategoryForm(){
    //for validation of category
    var categoryName = document.getElementById('category-name').value.trim();
    var errorSpan = document.getElementById('category-name-error');

    if (categoryName === '') {
        errorSpan.textContent = 'Please enter a category name';
        return false;
    } else{
        errorSpan.textContent = '';
        return true;
    }
}

function validateCreateAssignmentForm(){
    //for validation of assignment question
    var assignmentText = document.getElementById('assignment-text').value.trim();
    var assignmentDeadline = document.getElementById('assignment-deadline').value;
    var textError = document.getElementById('assignment-text-error');
    var deadlineError = document.getElementById('assignment-deadline-error');
    
    textError.textContent = deadlineError.textContent = '';

    if (assignmentText === '') {
        textError.textContent = 'Please enter some assignment text';
        return false;
    } else if (assignmentDeadline === ''){
        deadlineError.textContent = 'Please give a deadline for the assignment';
        return false;
    } else {
        return true;
    }
}

function validateSubmitFileForm(){
    var submittedFile = document.getElementById('submitted-file');
    var fileError = document.getElementById('submit-file-error');

    fileError.textContent = '';
     if (submittedFile.files.length === 0){
        fileError.textContent = 'Please select a file to upload';
        return false;
     } else {
        return true;
     }
}

// Function to display error modal from backend
function displayErrorModal(errorMessage) {
    $(document).ready(function() {
        $('#error-after-submission').modal({
            fadeDuration:200
        });
        $('#error-message').text(errorMessage);
    });
}

//displays the preview of file
function previewFile(fileName){
    if (fileName !== ''){
        var filePath = "../user uploads/" + fileName;
        window.open (filePath,'_blank');
    }
}

function validateUpdateAssignmentForm(){
    //for validation of assignment question
    var assignmentText = document.getElementById('update-assignment-text').value.trim();
    var assignmentDeadline = document.getElementById('update-assignment-deadline').value;
    var textError = document.getElementById('update-assignment-text-error');
    var deadlineError = document.getElementById('update-assignment-deadline-error');
    
    textError.textContent = deadlineError.textContent = '';

    if (assignmentText === '') {
        textError.textContent = 'Please enter some assignment text';
        return false;
    } else if (assignmentDeadline === ''){
        deadlineError.textContent = 'Please give a deadline for the assignment';
        return false;
    } else {
        return true;
    }
}

function passAssignmentIdForUpdate(assignmentId){
    document.getElementById('update-assignment-id').value = assignmentId;
}

//make user comfirm to delete the required data
function confirmAssignmentDelete(data) { //deletes whatever data is passed through here usually function name is passed for easy understanding
    const returnValue = confirm("Are you sure you want to delete this?");
    var assignmentId = document.getElementById('delete-assignment-id').value;
    event.preventDefault();
    if (returnValue == true){
        $.ajax({
            type: "POST",
            url: "../database/value_modify.php",
            data: { functionName : data , someId : assignmentId}, 
            success: function(response) {
                if (response == 1){
                    alert("Data deleted successfully.Reload to view change:");
                    // $('#success-message').text("Successfully Deleted.Reload to see changes");
                    // $('#success-after-submission').show();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Handle any errors
            }
        });
    } else {
        return false;
    }
}

function deleteSubmission(submissionid){
    $.ajax({
        type: "POST",
        url: "../database/value_modify.php",
        data: { submissionid: submissionid },
        success: function(response) {
            alert("Data deleted successfully.Reload to view change: " + response);
        },
        error: function(xhr) {
            alert("Error: " + xhr.responseText);
        }
    });
}

function validateEditFileForm(){
    var submittedFile = document.getElementById('edit-submission-file');
    var fileError = document.getElementById('edit-file-error');

    fileError.textContent = '';
     if (submittedFile.files.length === 0){
        fileError.textContent = 'Please select a file to upload';
        return false;
     } else {
        return true;
     }
}