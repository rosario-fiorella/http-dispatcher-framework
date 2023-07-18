<?php

declare(strict_types=1);

namespace App\Http\Filters;

use \Core\Http\Interfaces\Filter as FilterInterface;
use \Core\Http\Negotiation;
use \Core\Http\Request;
use \Core\Http\Response;
use UnexpectedValueException;

class Generic implements FilterInterface
{
    #[Override]
    public function init(Request $request, Response $response, Negotiation $negotation): void
    {
        if ($request->getHeader('HTTP_CONNECTION')) {
            return;
        }

        throw new UnexpectedValueException(_('error.request.notAllowed'), 403);
    }

    #[Override]
    public function destroy(Request $request, Response $response, Negotiation $negotation): void
    {
    }
}
