function add_product(id, items){
    let form=new FormData();
    form.append('product_id', id);
    form.append('count', items);
    let request_options={method: 'POST', body: form};
    fetch('https://pr-pivovarova.сделай.site/cart/create', request_options)
        .then(response=>response.text())
        .then(result=>{
            console.log(result)
            let title=document.getElementById('staticBackdropLabel');
            let body=document.getElementById('modalBody');
            if (result=='false'){
                title.innerText='Ошибка';
                body.innerHTML="<p>Ошибка добавления товара. Вероятно, товар уже раскупили.</p>"
            } else {
                title.innerText='Информационное сообщение';
                body.innerHTML="<p>Товар успешно добавлен в корзину.</p>"
            }
            let myModal = new
            bootstrap.Modal(document.getElementById("staticBackdrop"), {});
            myModal.show();
        })
}

function make_order()
{

    let formdata = new FormData();
    let input=document.getElementById('password');
    let password=input.value;
    formdata.append("password", password);

    let requestOptions = {
        method: 'POST',
        body: formdata,
    };

    fetch("https://pr-pivovarova.xn--80ahdri7a.site/order/create", requestOptions)
        .then(response => response.text())
        .then(result => {
            if (result=='false'){
                let error=document.getElementById('error');
                error.style.display='block';
            }
            else {
                let url='https://pr-pivovarova.xn--80ahdri7a.site/order/index?OrdertSearch[user_id]='+result;
                document.location.href=url;
            }
        })
        .catch(error => console.log('error', error));
}

function cart_update(){
    let form= new FormData(document.getElementsByTagName('form')[0]);
    let requestOptions = {
        method: 'POST',
        body: form
    };
    let id=document.getElementById('cart-product_id').value*1
    fetch("https://pr-pivovarova.xn--80ahdri7a.site/cart/update?id=" +id, requestOptions )
        .then(response=>response.text())
        .then(text=>{
            if (text==='false'){
            let message=document.getElementsByClassName('error')[0];
            message.style.display='block';
            message.innerText='Ошибка добавления товара';
            message.style.color='red';}
else
            {let message=document.getElementsByClassName('error')[0];
            message.style.display='block';
            message.innerText='Товар успешно добавлен';
            message.style.color='green';}
        })
}
