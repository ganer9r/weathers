<?php
use Illuminate\Http\JsonResponse;
use service\{{name}}Service;

class {{name}}Controller extends BaseController {

    /**
     * 설명
     * @link get /test/test - routes 정보
     *
     * @return JsonResponse
     */
    public function test()
    {
        $result = 'test';
        return Response::json(array(
            'result'=>$result
        ));
    }

}
