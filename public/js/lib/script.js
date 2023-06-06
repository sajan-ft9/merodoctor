// Add your code here
window.onload = function() {
    var modalInput = document.getElementById("modal-nepali-datepicker");
    modalInput.nepaliDatePicker({
        container: '#exampleModal'
    });
};

$(document).ready(function(){
    var currentDate = NepaliFunctions.ConvertDateFormat(NepaliFunctions.GetCurrentBsDate(), "YYYY-MM-DD");
    $('#nepali-datepicker-1').val(currentDate);

    $('.nepali-datepicker').nepaliDatePicker({
        ndpYear: true,
        ndpMonth: true,
        ndpYearCount: 10
    });
});
