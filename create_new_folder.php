<?php

$currentDir = getcwd();

/* From this folder I want to create a subfolder called downloads*/
if (mkdir($currentDir . "/downloads", 0777))
{
  echo "Directory has been created with success!";
}
else
{
  echo "Failed to create the directory!";
}

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
