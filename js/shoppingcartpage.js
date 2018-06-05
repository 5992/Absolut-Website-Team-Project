$(document).ready( () => {
  
  //get the shopping list
  const cartData = { action: 'list' };
  console.log(cartData);
  $.ajax({
    url: '/ajax/shoppingcart.ajax.php',
    method: 'post',
    dataType: 'json',
    data: cartData
  })
  .done((response) => {
    if( response.success == true ){
      response.items.forEach((item) => {
        let itemId = item.item_id;
        let productId = item.product_id;
        let productName = item.name;
        let productPrice = item.price;
        let quantity = item.quantity;
        let image = item.image;
        let template = `<div class="row">
          <div class="col-4">
            <img class="img-fluid" src="/images/products/${image}">
          </div>
          <div class="col-3">
            <h5>${productName}</h5>
            <p>${productPrice}</p>
          </div>
          <div class="col-5">
          <form id="shopping-list-form-${itemId}" class="shopping-list-form">
            <div class="form-row">
              <div class="col">
                <input type="hidden" name="productId" value="${productId}">
                <input type="hidden" name="itemId" value="${itemId}">
                <input type="number" name="quantity" class="form-control" value="${quantity}">
              </div>
              <div class="col">
                <button type="button" class="btn btn-outline-info btn-block" data-product-id="${productId}" data-item-id="${itemId}" data-action="update">
                  Update
                </button>
              </div>
              <div class="col">
                <button type="button" class="btn btn-outline-info btn-block" data-product-id="${productId}" data-item-id="${itemId}" data-action="delete">
                  Delete
                </button>
              </div>
            </div>
          <form>
          </div>
        </div><hr>`;
        $('#shopping-list').append(template);
      });
    }
  });
  
  
  //shopping list listener
  //listen for click on shopping cart list and update or delete item(s)
  $('#shopping-list').click( (event) => {
    let target = event.target;
    let action = $(target).data('action');
    console.log( action );
    if( action == 'update' ){
      let itemId = $(target).data('item-id');
      let productId = $(target).data('item-id');
      
    }
  });
  
});