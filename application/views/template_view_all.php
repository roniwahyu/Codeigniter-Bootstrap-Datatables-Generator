{php_open} echo anchor('admin/{nama_tabel}/add','add');{php_close}
<br>
{php_open} echo anchor('admin/front','back');{php_close}
{php_open} echo form_open('admin/{nama_tabel}/delete');{php_close}


<table border="1">


    <tr>
        {primary_key_tabel}
        <td>{primary_key}</td>
       
        {fields_tabel1}
        <td>{name_field_table}</td>
        {/fields_tabel1}
        <td>Action</td>

    </tr>
    {php_open} foreach (${nama_tabel}s as ${nama_tabel}) { {php_close}

        <tr>
            <td>{php_open} echo form_checkbox('{primary_key}[]',${nama_tabel}['{primary_key}']).${nama_tabel}['{primary_key}']; {php_close}</td>

             {fields_tabel2}
            <td>{php_open} echo ${nama_tabel}['{name_field_table}']; {php_close}</td>
           {/fields_tabel2}
            <td><a href="{php_open} echo site_url().'/admin/{nama_tabel}/form_update/'.${nama_tabel}['{primary_key}'];{php_close}" >Edit</a>
        </tr>
 {/primary_key_tabel}
{php_open} } {php_close}
</table>
{php_open} echo $pagination; {php_close}
<br>
<input type="submit" value="delete" onclick="return confirm('are you sure ?');">

{php_open} echo form_close();{php_close}