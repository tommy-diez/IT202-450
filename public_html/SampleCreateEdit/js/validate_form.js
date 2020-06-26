function validate() {

    errors = [];
    var product_name = document.getElementById("product_name").value;
    var quantity = document.getElementById("quantity").value;
    var price = document.getElementById("price").value;
    var description = document.getElementById("description").value;

    if (product_name == "" || quantity == "" || price == "" || description ==""){
        alert("Leave no fields empty");
        return false;
    }
    

}

