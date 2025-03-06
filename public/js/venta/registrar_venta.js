let id_cliente;
let productos=[];

$(function(){

    $("#cliente").autocomplete({
		source:function(request,response){
			$.ajax({
				url:'/cliente/list_clientes',
				dataType:'json',
				data:{'texto':request.term},
				success:function(data){
					response($.map(data.data,function(item){
						return {
							id:item.id_cliente,
							value:`${clear_null(item.apellido_paterno)} ${clear_null(item.apellido_materno)} ${clear_null(item.nombres)}`,
							label:`${clear_null(item.apellido_paterno)} ${clear_null(item.apellido_materno)}, ${clear_null(item.nombres)}`,

						}
					}));
				},
			});
		},
        minLength:1,
		delay: 500,
		select:function(event,ui){
            id_cliente=ui.item.id;
		}
	});

    $.fn.select2.defaults.set('language', 'es');

    $('#producto').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: 'Escriba nombre producto',
        allowClear: Boolean($(this).data('allow-clear')),
        closeOnSelect: !$(this).attr('multiple'),
        minimumInputLength: 3,
        ajax: {
            url: '/producto/list_productos',
            type:'GET',
            dataType:'json',
            delay:250,

            data: function (params) {
                let query = {
                    search: params.term
                }

                return query;
            },
            processResults:function(data){
                let datos=[];
                data.data.forEach(item => {
                    datos.push({'id':item.id_producto,'text':`${item.nombre_producto} (stock-${item.stock}:: precio-${item.precio} )`,'stock':item.stock,'precio':item.precio,'nombre_producto':item.nombre_producto });
                });

                return{
                    results:datos
                }
            }
        }
    });

    $('#producto').on("select2:select", function (e) {
        let cantidad=$("#cantidad").val();
        productos.push({'id_producto':e.params.data.id,'cantidad':cantidad,'nombre_producto':e.params.data.nombre_producto,'precio':e.params.data.precio});

        $("#cantidad").val(1);
        $("#producto").val(null).change(); console.log(productos);
        $("#tbl_productos tbody").html(llenar_tabla());
    });

    $("#btn_grabar").click(function(e){
        e.preventDefault();

        grabar_venta(productos,id_cliente);
    });

});

$(document).on('select2:open', () => {
    document.querySelector('.select2-container--open .select2-search__field').focus();
});

function clear_null(texto){
    if(texto==null) {
        return '';
    }
    return texto;
}

function llenar_tabla()
{
    let tabla='';
    let total=0;
    for (let i = 0; i < productos.length; i++) {
        tabla +=`
        <tr>
            <td>${i+1}</td>
            <td>${productos[i].id_producto}</td>
            <td>${productos[i].nombre_producto}</td>
            <td  style="text-align:center" >${productos[i].cantidad}</td>
            <td  style="text-align:right"  >${productos[i].precio}</td>
            <td  style="text-align:right" >${Number(productos[i].cantidad)*Number(productos[i].precio)}</td>
            <td></td>
        </tr>
        `;

        total+=Number(productos[i].cantidad)*Number(productos[i].precio);
    }

    tabla+=`
        <tr>
            <th colspan="5"  style="text-align:right" >TOTAL: </th>
            <th style="text-align:right" >${total}</th>
            <th></th>
        </tr>
    `;

    return tabla;
}

async function  grabar_venta(lista_producto,codigo_cliente)
{
    let data=new FormData();
    data.append('cliente',codigo_cliente);

    for (let i = 0; i < lista_producto.length; i++) {
        data.append('producto_codigo['+i+']',lista_producto[i].id_producto);
        data.append('producto_cantidad['+i+']',lista_producto[i].cantidad);
    }

    //data.append('producto',lista_producto);

    await axios.post('/venta/registrar_venta_store',data)
    .then(response=>{
        let data=response.data.data;

    }).catch(error=>{
        let status=error.response.status;
        let data=error.response.data;
        if(status===422){
            // $.each(data.errors,function(prefix,val){
            //     let padre=$(`#mt_${prefix}`).parents('.fields_validate');
            //     padre.find('.invalid-feedback').text(val[0]);
            // });

            Swal.fire({
                icon:'error',
                text:'Ingrese los valores requeridos'
            });
        }else{
            Swal.fire({
                icon:'error',
                text:data.message
            });
        }
    });
}

