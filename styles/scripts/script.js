function validate() {
  var fullname = document.forms["login-form"]["fname"].value;
  var uname = document.forms["login-form"]["username"].value;
  var pass = document.forms["login-form"]["password"].value;
  var pass2 = document.forms["login-form"]["confirm-password"].value;
  var phone = document.forms["login-form"]["phone"].value;

  if(fullname.length > 15){
    alert("your name is Out of bound");
    return false;
  }else if(uname.length >8){
    alert("Username should be less than 8 letters");
    return false;
  }else if (!(pass.length > 8)) {
    alert("password must contain greater than 8 char");
    return false;
  }else if (pass!==pass2) {
    alert("use 1st pass");
    return false;
  }else if(phone.length >= 20 || phone.length <= 9){
    alert("phone number should be <=9 and <=15");
    return false;
  }
}
function showCategory(categoryId) {
  // Hide all category sections
  var categorySections = document.querySelectorAll('.category-section');
  categorySections.forEach(function(section) {
    section.style.display = 'none';
  });

  // Show the selected category
  var selectedCategory = document.getElementById(categoryId);
  if (selectedCategory) {
    selectedCategory.style.display = 'block';
  }
}

