<?php
use Illuminate\Http\JsonResponse;
use service\TestService;

class TestController extends BaseController {

    public function test()
    {
        $result = 'test';
        return Response::json(array(
            'result'=>$result
        ));
    }

    public function getTest($version)
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

        $sample = TestService::getInstance()->getTest($inputs['sample']);
        return Response::json(array("sample" => $sample));
    }
}