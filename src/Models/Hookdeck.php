<?php

namespace Skyfiber\Models;

use Psr\Http\Message\ServerRequestInterface as Request;

class Hookdeck
{

    /**
     * @throws \Exception
     */
    public function isValid(Request $request): void
    {
        if ('' === $request->getHeaderLine('x-hookdeck-signature')) {
            throw new \Exception('Unauthorized', 403);
        }

        if ('' === $request->getHeaderLine('x-skyfiber-form')) {
            throw new \Exception('x-skyfiber-form is required', 500);
        }

        if (!in_array($request->getHeaderLine('x-skyfiber-form'), $this->getForms())) {
            throw new \Exception('x-skyfiber-form values can be: ' . implode(',', $this->getForms()), 500);
        }

        $hmacHeader = $request->getHeaderLine('x-hookdeck-signature');
        $hash = base64_encode(hash_hmac('sha256', $request->getBody()->getContents(), $_ENV['HOOKDECK_SIGNATURE'], true));

        if (!hash_equals($hmacHeader, $hash)) {
            throw new \Exception('Unauthorized', 403);
        }
    }

    /**
     * Gets a list of form names for validation of hookdeck
     *
     * @return array
     */
    public function getForms(): array
    {
        $return = [];

        $path = __DIR__ . '/Forms';
        $allFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        $phpFiles = new \RegexIterator($allFiles, '/\.php$/');
        /** @var \SplFileInfo $file */
        foreach ($phpFiles as $file) {
            $return[] = substr($file->getFilename(), 0, (strlen($file->getFilename()) - 4));
        }

        return $return;
    }

}