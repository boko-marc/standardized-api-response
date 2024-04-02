<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


/**
 * ***`JsonResponseTrait`***
 *
 * This trait provides reusable methods for creating JSON responses with different structures such as success responses,
 * error responses, and validation error responses. It abstracts away the common logic of creating JSON responses,
 * making it easier and more consistent to handle responses in your application.
 *
 *  */
class JsonResponseTrait
{

    /**
     * Create a JSON response.
     *
     * @param  array       $data         The data to be included in the response.
     * @param  int         $status_code   The HTTP status code.
     * @param  array|null  $headers      Additional headers for the response.
     * @param  int|null    $options      JSON encoding options.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response(array $data, $status_code = Response::HTTP_OK, $headers = [], $options = null): JsonResponse
    {
        return response()->json($data, $status_code, $headers, $options);
    }

    /**
     * Create a `success` JSON response.
     *
     * @param  mixed       $data              The data to be included in the response.
     * @param  int         $statusCode        The HTTP status code.
     * @param  array|null  $headers           Additional headers for the response.
     * @param  int|null    $options           JSON encoding options.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($message = null, $data = null, int $status_code = Response::HTTP_OK, $headers = [], $options = null): JsonResponse
    {
        $responseData = [
            'status' => true,
            'message' => $message,
            'data' => $data,
            'status_code' => $status_code
        ];

        return static::response($responseData, $status_code, $headers, $options);
    }

    /**
     * Create an `error` JSON response.
     *
     * @param  string      $message           The error message.
     * @param  int         $status_code       The HTTP status code.
     * @param  array|null  $headers           Additional headers for the response.
     * @param  int|null    $options           JSON encoding options.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message = null, $status_code = Response::HTTP_INTERNAL_SERVER_ERROR, $errors = null, $headers = [], $options = null): JsonResponse
    {
        $responseData = [
            'status' => false,
            'message' => $message,
            'errors' => $errors,
            'status_code' => $status_code
        ];

        return static::response($responseData, $status_code, $headers, $options);
    }

    /**
     * Create a `validation error` JSON response.
     *
     * @param  string      $message           The error message.
     * @param  int         $status_code       The HTTP status code.
     * @param  array       $errors            The validation errors.
     * @param  array|null  $headers           Additional headers for the response.
     * @param  int|null    $options           JSON encoding options.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validationErrorResponse($message, $status_code = Response::HTTP_UNPROCESSABLE_ENTITY, $errors = [], $headers = [], $options = null): JsonResponse
    {
        $responseData = [
            'status' => false,
            'message' => $message,
            'errors' => $errors,
            'status_code' => $status_code
        ];

        return static::response($responseData, $status_code, $headers, $options);
    }
}
