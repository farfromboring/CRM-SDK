<?php
namespace CRM_SDK\SharedObjects\File;

use CRM_SDK\SharedObjects\SharedObjectInterface;
use CRM_SDK\SharedObjects\Traits\CreateTrait;
use CRM_SDK\SharedObjects\Traits\IDAndNameTrait;
use CRM_SDK\SharedObjects\Traits\IDToArrayTrait;

class FileType implements SharedObjectInterface
{
    use CreateTrait;
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