<?php

namespace Reamaze\API;

class Category extends Resource {
    public static function path() {
        return "/" . self::$API_VERSION . "/categories";
    }
}
