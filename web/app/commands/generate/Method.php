public function get{{name}}($param1, $parm2)
{
    $package = RecommendServiceDao::getInstance()->selectPackageByPk($packageId);
    return $package;
}



