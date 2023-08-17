<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use App\Utils\HttpResponse;
use App\Utils\HttpResponseCode;

class Handler extends ExceptionHandler
{
    use HttpResponse;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $model = class_basename($e->getModel());

            return $this->error(
                "{$model} tidak ditemukan",
                HttpResponseCode::HTTP_NOT_FOUND
            );
        } else {
            switch (true) {
                case $e instanceof \Illuminate\Validation\ValidationException:
                    return $this->error(
                        $e->validator->errors(),
                        HttpResponseCode::HTTP_BAD_REQUEST
                    );
                case $e instanceof \Illuminate\Auth\Access\AuthorizationException:
                    return $this->error(
                        'Anda tidak memiliki hak akses',
                        HttpResponseCode::HTTP_UNAUTHORIZED
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException:
                    return $this->error(
                        'Metode tidak diizinkan',
                        HttpResponseCode::HTTP_METHOD_NOT_ALLOWED
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\BadRequestHttpException:
                    return $this->error(
                        'Bad request',
                        HttpResponseCode::HTTP_BAD_REQUEST
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException:
                    return $this->error(
                        'Terlalu banyak requests',
                        HttpResponseCode::HTTP_TOO_MANY_REQUESTS
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException:
                    return $this->error(
                        'Terlarang',
                        HttpResponseCode::HTTP_FORBIDDEN
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\ConflictHttpException:
                    return $this->error(
                        'Data telah tersedia',
                        HttpResponseCode::HTTP_CONFLICT
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException:
                    return $this->error(
                        'Jenis media tidak didukung',
                        HttpResponseCode::HTTP_UNSUPPORTED_MEDIA_TYPE
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException:
                    return $this->error(
                        'Entitas tidak dapat diproses',
                        HttpResponseCode::HTTP_UNPROCESSABLE_ENTITY
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException:
                    return $this->error(
                        'Servis tidak tersedia',
                        HttpResponseCode::HTTP_SERVICE_UNAVAILABLE
                    );
                case $e instanceof \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException:
                    return $this->error(
                        'Tidak dapat diterima',
                        HttpResponseCode::HTTP_NOT_ACCEPTABLE
                    );
                default:
                    return $this->error(
                        $e->getMessage(),
                        HttpResponseCode::HTTP_INTERNAL_SERVER_ERROR
                    );
            }
        }

        return parent::render($request, $e);
    }
}
