function confirmdelete( type, root, title, id )
  {
  var r=confirm("Are you sure you want to delete "+title+"? You will not be able to retrieve this information after it is gone. Please consider this very carefully.")
  if (r==true)
    {
    window.location=root+"hsr-admin/delete.php?type="+type+"&id="+id
    }
  else
    {
    
    }
  }