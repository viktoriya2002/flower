function update_cart(id, items, i)
{
    let form=new FormData();
    form.append('product_id', id);
    form.append('count', items*1);

    let request_options=
    {
        method: 'POST', 
        body: form
    };

    fetch('https://pr-pivovarova.сделай.site/cart/create', request_options)
        .then(response=>response.text())
        .then(result=>
            {
            console.log(result)
            let title=document.getElementById('staticBackdropLabel');
            let body=document.getElementById('modalBody');
            if (result=='false')
            {
                title.innerText='Ошибка';
                body.innerHTML="<p>Ошибка добавления товара. Вероятно, товар уже раскупили.</p>"
            } else 
            {
                title.innerText='Информационное сообщение';
                body.innerHTML="<p>Количество товара изменено.</p>";

                let table=document.getElementsByTagName('table')[0];
                let cell=table.rows[i].cells[3].innerText*1+items;
                table.rows[i].cells[3].innerText=cell;
                
            }

            let myModal = new
            bootstrap.Modal(document.getElementById("staticBackdrop"), {});
            myModal.show();
        })
}