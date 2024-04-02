//loads questions using fetch_question within the right container of assignment page
function loadQuestion(categoryId){
    $.ajax({
        type: "POST", // Use POST as the method
        url: "fetch_questions.php", // The URL to send the request to
        data: {categoryId: categoryId}, // Data to send in the request
        success: function(response) {
            // On success, update the .right element's HTML with the response
            $(".right").html(response);
            loadAccordion(); // Call loadAccordion here
            keepSelected();
        },
        error: function(xhr, status, error) {
            // Optionally handle errors
            console.log("Error: " + error);
        }
    });
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

function loadAccordion(){
    jQuery(document).ready(function($) {
        //initially hide the question and preview part and the buttons
        $('.assignment-title .question').hide();
        $('.hidden-button').hide();

        //then show the content of whichever clicked
        $('.assignment-title .title-name').click(function(){

          $(this).siblings('.question').slideToggle('slow', function(){  //Expand or collapse this(selected) panel
            if ($('.assignment-title .question').is(':visible')) {   //After toggle, check if any question is visible
                $('.buttons .hidden-button').show(); //If any question is visible, show the button
            } else { 
                $('.buttons .hidden-button').hide();  //If no questions are visible, hide the button
            }
          });
          $(".assignment-title .question").not($(this).siblings('.question')).slideUp('slow');  //Hide the other panels
        });
      });
}