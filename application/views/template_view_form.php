
{php_open}
if ($type_form == 'post') {

    echo form_open('admin/{nama_tabel}/add');
} else {

    echo form_open('admin/{nama_tabel}/update');
}
{php_close}

{fields_tabel1}
{php_open} echo form_error('{name_field_table}'); {php_close}
{/fields_tabel1}
<table border="0">
    {primary_key_tabel}
    <tr>
        <td>{primary_key}-if the primary key is auto_increment then delete this field </td>
        <td><input type="text" name="{primary_key}" value="{php_open} if(isset ($isi['{primary_key}'])){echo $isi['{primary_key}'];}{php_close}" /></td>
    </tr>
    {/primary_key_tabel}
   {fields_tabel2}
    <tr>
        <td>{name_field_table}</td>
        <td><input type="text" name="{name_field_table}" value="{php_open} if(isset ($isi['{name_field_table}'])){echo $isi['{name_field_table}'];}{php_close}" /></td>
    </tr>
    {/fields_tabel2}
   
    <tr>
        <td></td>
        <td>
               {php_open} if ($type_form == 'post') { {php_close}
            <input type="submit" name="post" value="Submit" />
               {php_open} } else { {php_close}
{primary_key_tabel2}
             {php_open} if(isset ($isi['{primary_key}'])){ echo form_hidden('{primary_key}',$isi['{primary_key}']);}{php_close}
{/primary_key_tabel2}
            <input type="submit" name="update" value="update" />       
            
                {php_open} } {php_close}

        </td>
    </tr>
</table>




<?php echo form_close() ?>