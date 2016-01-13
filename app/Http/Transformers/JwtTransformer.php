<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract as Transformer;

class JwtTransformer extends Transformer
{
    public function transform($array)
    {
        return [
            'token' => $array[0],
            'user' => $array[1],
            'role' => $array[2],
            'permissions' => $array[3],
        ];
    }
}