    public function {{controller_method}}($version)
    {
        $validator = Validator::make(
            $inputs = array(
                "test" => Input::get('test'),
            ),
            array(
                "test" => "required|numeric|digits_between:1,20",
            )
        );
        if ($validator->fails()) {
            return Response::json(array("messages" => $validator->messages(), "code" => "ERR_VALIDATE"), 400);
        }

        $sample = {{service_class}}::getInstance()->{{service_method}}($inputs['sample']);
        return Response::json(array("sample" => $sample));
    }



