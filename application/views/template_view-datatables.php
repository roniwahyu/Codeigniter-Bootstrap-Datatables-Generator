{php_open} $this->load->view('main/header');{php_close}
       <div class="container-fluid">
        <div class="row-fluid">
            <div id="" class="brand span12">
                    <h1 class="">{nama_tabel} Management</h1>
            </div>
            <div class="span3">
                <div id="form_input" class="">
                {php_open} if(!empty(${nama_tabel})){ echo var_dump(${nama_tabel});}{php_close}
                {php_open} echo form_open('{nama_tabel}/submit',array('id'=>'addform','class'=>'form form-vertical')); {php_close}
                    {primary_key_tabel}
                    <input type="hidden" value='' id="{primary_key}" name="{primary_key}">
                    {fields_tabel1}
                    <div class="control-group">
                            {php_open} echo form_label('{name_field_table} : ','{name_field_table}',array('class'=>'control-label')); {php_close}
                            <div class="controls">
                                {php_open} echo form_input('{name_field_table}','','id="{name_field_table}"'); {php_close}
                            </div>
                    </div>
                    {/fields_tabel1}
                    <button id="save" type="submit" class="btn btn-success"><icon class="icon-plus-sign"></icon> Add New</button>
                    <button id="save_edit" type="submit" class="btn btn-primary" style="display:none;"><icon class="icon-refresh"></icon> Update</button>

                    {php_open} echo form_close();{php_close}
                 </div>
            </div>
            <div class="span9">

                <form id="form_del_all" method="post" class="form_del_all" action="{php_open} echo base_url();{php_close}data/delete" >
                <table id="datatables" class="table table-condensed table-striped">
                    <thead class="">
                        <tr>
                                        <th>{primary_key}</th>
                                        {fields_tabel2}<th>{name_field_table}</th>
                                        {/fields_tabel2}<th>Actions</th><th><input type="checkbox" id="selectallcheck" name="allcheck"/> </th>
                                    </tr>
                    </thead>

                    <tbody class="table-bordered">
                        <tr>
                            <td colspan="6" class="dataTables_empty">Loading data...</td>
                            
                        </tr>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
        
    </div>

{php_open} $this->load->view('main/footer');{php_close}
<script>
    $(document).ready(function(){
        $("#date").datepicker({
                    dateFormat: 'yy-mm-dd',
                });
         $('#selectallcheck').click (function () {
             var checkedStatus = this.checked;
            $('#datatables tbody tr').find('td:last :checkbox').each(function () {
                $(this).prop('checked', checkedStatus);
             });
        });
        //declare all html button as jqery button
        $("button").button();

        oTable=$('#datatables').dataTable({
            "sAjaxSource":"{php_open} echo base_url();{php_close}{nama_tabel}/getdatatables",
            "sScrollY": "300px",
            "sServerMethod": "POST",
            "bServerSide": true,
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "bAutoWidth": false,
            "bDeferRender": true,
            "bSortClasses": false,
            "bScrollCollapse": true,    
            "bStateSave": true,
            "aoColumns": [
                
                { "sClass": "{primary_key}","sName": "{primary_key}","sWidth": "50px", "aTargets": [0] } ,{fields_tabel3}
                { "sClass": "{name_field_table}", "sName": "{name_field_table}", "sWidth": "80px", "aTargets": [ 1 ] },{/fields_tabel3}
                { "sClass": "center", "bSortable": false, "bSearchable": false, "sWidth": "100px","mData": 0,
                    "mDataProp": function(data, type, full) {
                    return "<div class='btn-group'><button class='edit btn btn-mini btn-success' id='"+data[0]+"'><icon class='icon-pencil'></icon></button><button class='delete btn btn-mini btn-danger'id='"+data[0]+"'><icon class='icon-remove'></icon></button><button class='detail btn btn-mini btn-primary' id='"+data[0]+"'><icon class='icon-cog'></icon></button></div>";
                }},
                { "sClass": "center", "bSortable": false, "bSearchable": false, "sWidth": "60px",
                    "mDataProp": function(data, type, full) {
                    return "<input class=\" btn btn-danger btn-mini\" value='"+ data[0]+"' type='checkbox' id='id['"+ data[0] +"]' name='del_all' />";
                }}
            ],
        });

        function save({primary_key}){
            var dataform={
                {primary_key}:$('#{primary_key}').val(),{fields_tabel4}
                {name_field_table}:$('#{name_field_table}').val(),{/fields_tabel4}
                ajax:1
            };
            $(this).ready(function(){
                $.ajax({
                    url:"{php_open} echo base_url();{php_close}{nama_tabel}/submit",
                    data:dataform,
                    type:"POST",
                    success:function(){
                        $('button#save').fadeIn(200);
                        $('button#save_edit').hide(200);
                        
                        oTable.fnClearTable( 0 );
                        oTable.fnDraw();

                       
                        $('#{primary_key}').val(''); {fields_tabel5}
                        $('#{name_field_table}').val('');{/fields_tabel5}
                       
                       // $('#name').focus();

                       
                    }
                });
            });
        }
        $("#addnew form").submit(function(e){   
            e.preventDefault();
            save(0);
        });
        
        $("button#save").live("click",function(e){
            e.preventDefault();
            save(0);
        });
        
        $("button#save_edit").live("click",function(e){
        
            e.preventDefault();
                var id=$(this).attr("id");
                save(id);
            
        });     

        $('button.edit').live("click",function(e){
            e.preventDefault();
            var id=$(this).attr("id");
            $(this).ready(function(){
                    $.ajax({
                        url:"{php_open} echo base_url();{php_close}{nama_tabel}/get/"+id,
                        type:"get",
                        dataType:"json",
                        success:function(data){{fields_tabel6}
                            $('#{name_field_table}').val(data.{name_field_table});{/fields_tabel6}
                            $('#{primary_key}').val(data.{primary_key});

                            $('button#save').hide(200);
                            $('button#save_edit').fadeIn(200);
                            
                            oTable.fnClearTable( 0 );
                            oTable.fnDraw();
                        }
                    });
            });
            
        });


        $("button.delete").live("click",function(e){
            e.preventDefault();
                var del_data={
                    id:$(this).attr("id"),
                    ajax:1
                }
                if(confirm('Are You Sure?')){
                    $(this).ready(function(){
                            
                        $.ajax({
                            url: "{php_open} echo base_url(){php_close}{nama_tabel}/delete/",
                            type: 'POST',
                            data: del_data,
                            success:function(msg){
                                oTable.fnDraw(true);
                            }
                        });
                    });
                }
        });


        {/primary_key_tabel}
    });
</script>
</body>
</html>