<div id='entity' class="d-none"><?=$args['entity']?></div>
<!-- Modal -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
                </div>
                <div class="modal-body">Deseja realmente excluir este item? </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="del">Sim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row"> 
                <div class="col-md-12 m-3 p-2 entity_header">
                    <h5><?=ucwords($args['entity_verbose'])?></h5>
                </div>
            </div> 
            <?php if(count(array_keys($args['input_types'])) > 0 ){?>
                <?php foreach ($args['elements'] as $key => $item) {?>
                   <div class="row">                
                     <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header d-inline-flex">
                                <div class="col-md-8 info" id="<?=$args['entity'].'-'.$item['id']?>">
                                        <ul class="card-header"> 
                                            <?php foreach ($item as $column_name => $column_value) { ?>
                                                <li verbose_key='<?=$args['verbose_name'][$column_name]?>' key='<?=$column_name?>' value='<?=$column_value?>' input_type='<?=$args['input_types'][$column_name]?>' class='<?=$args['input_types'][$column_name]?>'><?=$args['verbose_name'][$column_name]." : <span class='itemvalue'>".$column_value."</span>";?>  
                                            </li> 
                                        <?php } ?>
                                    </ul>
                                </div>
                                
                                <div class=col-md-4>
                                    <div class="actions d-inline-flex p-1 text-white">
                                        <?php if($args['entity'] == 'devedores' ){?>
                                        <a class="btn btn-success btn-xs mx-2 viewItem" href="../devedor/<?=$item['id'] ?>">&#128065;</a>
                                            <?php } ?>
                                         <a class="btn btn-warning btn-xs mx-2 editItem" itemid="<?=$item['id']?>" entity="<?=$args['entity']?>">&#128393;</a>
                                         <a class="btn btn-danger btn-xs mx-2 delItem"  href="#" data-toggle="modal" data-target="#delete-modal" itemid="<?=$item['id']?>" entity="<?=$args['entity']?>">&#128465;</a>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div> 
                </div>
            <? } #endfor ?>
        <?php } ?>
        <?php if($args['entity']!=='devedor'){?>
        <div class="row"> 
            <div class="col-md-1 mb-3">  
             <div class="card">                      
                <button class="btn btn-primary calladd" title='Adicionar <?=$args["entity"]?>'>&#x2B;</button>
            </div>
        </div>
        </div>
    
    <div class="container-fluid divAddEntity">
        <div class="row my-4"> 
            <div class="col-md-12 ">
                <div class="row"> 
                    <div class="card col-md-8 " id="addEntity">
                        <h5 class="card-header">
                            Adicionar <?=$args['entity']?>
                        </h5> 
                        <div class="card-body">
                            <form action="/<?=$args['entity']?>" method="post" enctype="multipart/form-data" id="form">
                                <fieldset> 
                                    <?php foreach($args['input_types'] as $key => $value){?>
                                        <div class="form-group">
                                           <?php if($value != 'hidden' ){?>
                                               <label><?=$args['verbose_name'][$key]?></label>
                                           <?php } ?>
                                           <input type="<?=$value?>" placeholder="" name="<?=$key?>" value="" id="<?=$value?>" class="form-control" >
                                       </div>
                                   <?php } ?>
                                   <div class="form-group">
                                    <button type="submit" class="btn btn-primary js-tooltip" id=  />Adicionar
                                    </button>
                                    </div>
                                </fieldset>
                        </form>
                    </div>
                    <div class="card-footer">                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? }?>
</div>
</div>
</div>
</div>