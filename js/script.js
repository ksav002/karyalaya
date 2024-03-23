//loads questions using fetch_question within the right container of assignment page
function loadQuestion(categoryId){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".right").innerHTML = this.responseText;
        }
    };
    // Open a POST request to fetch_questions.php and send the category ID
    xhttp.open("POST", "fetch_questions.php",true);
    // post method use garda chahinxa yo
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // Send the request with the category ID
    xhttp.send("categoryId=" + categoryId);
}

function ajaxContentScript(){
    //for toggling up and down the assignments of assignments page
    $(document).ready(function(){
        $(".title-name").on('click',function(){
            $(this).siblings(".question").toggle("slow");
            $(this).siblings(".preview").toggle("slow");
        });
    });
}