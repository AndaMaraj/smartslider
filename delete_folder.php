<?php

$currentDir = getcwd();

/* Now we want to delete the folder that we created*/
function removeDirectory($path)
{
  $i = new DirectoryIterator($path);
  foreach ($i as $value)
  {
    if ($value->isFile())
    {
      unlink($value->getRealPath());
    }
    else if (!$value->isDot() && $value->isDir())
    {
      rmdir($value->getRealPath());
    }
  }
  rmdir($path);
}

removeDirectory("downloads");

 ?>
