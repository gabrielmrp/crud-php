<?php
 
include(dirname(__DIR__, 1).'/views/header.php');
include(dirname(__DIR__, 1).'/views/footer.php');
?>

<!-- C3 charts css -->
<link href="/static/plugins/c3/c3.min.css" rel="stylesheet" type="text/css"  />

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row"> 
                <div class="col-md-12 m-3 p-2 entity_header">
                    <h5>Dashboard de Acompanhamento</h5>
                </div>
            </div> 
        </div>
    </div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6 slot p-5">
					<h5>Nº de Clientes por Tipo de Pessoa</h5>
					<div id="s1"></div>
				</div>
				<div class="col-md-6 slot p-5">
					<h5>Montante de Dívidas por Tipo de Pessoa</h5>
					<div id="s2"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 slot p-5">
					<h5>Montante de Dívidas por Cliente</h5>
					<div id="s3"></div>
				</div>
				<div class="col-md-6 slot p-5">
					<h5>Montante de Dívidas por Data de Vencimento</h5>
					<div id="s4"></div>
				</div>
				 
			</div>
		</div>
	</div>
</div>

<!--C3 Chart-->
<script src="<?=$level?>/static/plugins/d3/d3.min.js"></script>
<script src="<?=$level?>/static/plugins/c3/c3.min.js"></script>

<script type="text/javascript">
 
	var chart_ts = c3.generate({
		  		//bindto: '#timeseries',
		  		data: {
		  			x: 'x',
			//        xFormat: '%Y%m%d', // 'xFormat' can be used as custom format of 'x'
			columns: 
			<?=$args["dashboard"]["vencimento_valores"]?> 
		},
		axis: {
			x: {
				type: 'timeseries',
				tick: {
					format: '%d/%m/%Y',
	                rotate: 75,
	                multiline: false
	             
				}
			}
		}
	}); 
	var chart_dv = c3.generate({
        	//bindto: '#bar',
        	data: {
        		columns: <?=$args["dashboard"]["devedor_valores"]?>,
        		type: 'bar' 
        	}, 
        	bar: {
        		width: {
        			ratio: 0.5,
        			space: 0.25
        		}
        	},
        	axis: {
        		rotated: true
        	}
        }); 

	var chart_dn  = c3.generate({
		data: { 
       columns: [
       ["Pessoa Física", <?=$args["dashboard"]["pessoa"]["Física"]?>],
       ["Pessoa Jurídica", <?=$args["dashboard"]["pessoa"]["Jurídica"]?>] 
       ],
       type : 'pie',
       colors: {
       	Jurídica: '#508aeb',
       	Física: '#ff5560',
       },
       onclick: function (d, i) { console.log("onclick", d, i); },
       onmouseover: function (d, i) { console.log("onmouseover", d, i); },
       onmouseout: function (d, i) { console.log("onmouseout", d, i); }
   	} 
	});

	var chart_dp= c3.generate({
		data: { 
       columns: [
       ["Pessoa Física", <?=$args["dashboard"]["dividas_pessoa"]["Física"]?>],
       ["Pessoa Jurídica", <?=$args["dashboard"]["dividas_pessoa"]["Jurídica"]?>] 
       ],
       type : 'pie',
       colors: {
       	Jurídica: '#508aeb',
       	Física: '#ff5560',
       },
       onclick: function (d, i) { console.log("onclick", d, i); },
       onmouseover: function (d, i) { console.log("onmouseover", d, i); },
       onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    } 
	});
	$("#s1").append(chart_dp.element);
	$("#s2").append(chart_dn.element);
	$("#s3").append(chart_dv.element);
	$("#s4").append(chart_ts.element); 
 
 </script>