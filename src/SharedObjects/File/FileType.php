<?php
namespace CRM_SDK\SharedObjects\File;

use CRM_SDK\Interfaces\APIObjectInterface;
use CRM_SDK\Traits\APIObjectTrait;
use CRM_SDK\Traits\IDAndNameTrait;
use CRM_SDK\Traits\IDToArrayTrait;

class FileType implements APIObjectInterface
{
    use APIObjectTrait;
    use IDToArrayTrait;
    use IDAndNameTrait;

    const IMAGE = 1;
    const PDF = 2;
    const VIDEO = 3;
    const AUDIO = 4;
    const WORD_DOC = 5;
    const SPREADSHEET = 6;
    const APPLICATION = 7;
    const ARCHIVE = 8;
    const OTHER = 9;
    const POWERPOINT = 11;
    const CODE = 12;
    const EMBROIDERY_IMPRINTING = 13;
}