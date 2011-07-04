<table width="100%">
    <tr>
        <td><?php print anchor('admin',$this->bep_assets->icon('widget/'.$size.'/jump_content'))?></td>
        <td><?php print anchor('admin',$this->bep_assets->icon('widget/'.$size.'/custom_search'))?></td>
        <td><?php print anchor('admin',$this->bep_assets->icon('widget/'.$size.'/favorites'))?></td>
        <td><?php print anchor('admin',$this->bep_assets->icon('widget/'.$size.'/share'))?></td>
        <td><?php print anchor('admin',$this->bep_assets->icon('widget/'.$size.'/jump_media'))?></td>
        <td width="100%">&nbsp;</td>
        <td><?php print anchor('admin',$this->bep_assets->icon('widget/'.$size.'/content_more'))?></td>
        <td><?php print anchor('admin',$this->bep_assets->icon('widget/'.$size.'/tools'))?></td>
    </tr>
    <tr>
        <form action="">
        <td colspan="7" width="100%">
            <input type="text" value="jump to" style="width:100%;"/>
        </td>
        <td>
            <button type="submit" name="submit" value="submit" >Go</button>
        </td>
        </form>
    </tr>
</table>