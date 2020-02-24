var subtotal;
var total;
var valor_Unitario;

//Método para agregar producto nuevo a la tabla
function insertProduct(){
	
	var producto = document.getElementById("producto");
	var selected = producto.options[producto.selectedIndex].text;
	var valP = producto.value;
	var arrayCadena = valP.split("--");
	valor_Unitario = arrayCadena[1];
	var newRow;

	newRow ='<td><div class="row_dataId_producto" edit_type="click" value="'+arrayCadena[0]+'"col_name="fid">'+arrayCadena[0]+'</div></td>';
	newRow +='<td><div class="row_dataName" edit_type="click" col_name="fname">'+selected+'</div></td>';
	newRow +='<td><div class="row_dataQuatity" edit_type="click" type="number" required="true" col_name="fquantity">'+1+'</div></td>';
	newRow +='<td><div class="row_dataValUn" edit_type="click" col_name="fvalU">'+valor_Unitario+'</div></td>';
	newRow +='<td><div class="row_dataCost" edit_type="click" col_name="fcosto">'+valor_Unitario+'</div></td>';
	newRow +='<td><div class="delete" edit_type="click" col_name="faction">'+
	'<a class="delete" style="color: #ffc107"onmousemove="underline(this)" onmouseout="blankunderline(this)">'+
	'eliminar</a></div></td>';

	var btn = document.createElement("tr");
   	btn.innerHTML=newRow;
    document.getElementById("tabla_productos").appendChild(btn);

    subtotal = 0;
    generateSubtotal();
}

function generateSubtotal(){
	$(".row_dataCost").each(function(){
	subtotal+=parseFloat($(this).html()) || 0;
	});
	setSubtotal();
}

function setSubtotal(){
	var saldoI = document.getElementById('saldo');
	var subtotalI = document.getElementById('subtotal');
	var totalI = document.getElementById('total');

	total = subtotal + (subtotal * 0.19);

	saldoI.value = subtotal;
	subtotalI.value = subtotal;
	totalI.value = total;
}

//--->save single field data > start
$(document).on('focusout', '.row_dataQuatity', function(event) 
{
	event.preventDefault();

	if($(this).attr('edit_type') == 'button')
	{
		return false; 
	}

	var row = $(this).closest('tr');
	var row_id = row.attr('row_id'); 
	
	var row_div = $(this)			
	.removeClass('bg-warning') //add bg css
	.css('padding','')

	var col_name = row_div.attr('col_name'); 
	var col_val = row_div.html(); 

	var arr = {};
	arr[col_name] = col_val;

	//use the "arr"	object for your ajax call
	$.extend(arr, {row_id:row_id});

	valor_Unitario = row.find('.row_dataValUn').html();

	row.find('.row_dataCost').html(col_val*valor_Unitario);
	subtotal = 0;
	generateSubtotal();
})	
//--->save single field data > end

//--->make div editable > start
$(document).on('click', '.row_dataQuatity', function(event) 
{
	event.preventDefault(); 

	if($(this).attr('edit_type') == 'button')
	{
		return false; 
	}

	//make div editable
	$(this).closest('div').attr('contenteditable', 'true');
	//add bg css
	$(this).addClass('bg-warning').css('padding','5px');

	$(this).focus();
})	
//--->make div editable > end

//Método para eliminar fila
$(document).on('click', '.delete', function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');
    subtotal = 0;
    generateSubtotal();
    row.remove();
});

$(document).ready(function () {
	$('#tabla_productos').DataTable({
	"scrollY": "200px",
	"scrollCollapse": true,
	});
	$('.dataTables_length').addClass('bs-select');
});

