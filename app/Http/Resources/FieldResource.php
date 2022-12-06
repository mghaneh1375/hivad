<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FieldResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $options = null;

        if($this->options != null) {
            $options = [];
            foreach(explode('__', $this->options) as $itr) {
                array_push($options, [
                    'label' => $itr,
                    'checked' => false,
                    'price' => null
                ]);
            }
        }

        return [
            'label' => $this->label,
            'cid' => $this->slug,
            "FormID" => null,
            "foreignTableFields" => null,
            "field_type" => $this->type,
            "required" => $this->is_required,
            "isPhonNumber" => $this['slug'] == 'phone' ? true : null,
            "IsNationalCode" => $this['slug'] == 'NID' ? true : null,
            "IsPrimaryKey" => null,
            "display" => true,
            "displayInAdmin" => null,
            "notEditable" => null,
            "IsUnique" => null,
            "FieldScore" => null,
            "field_options" => [
                "size" => $this['type'] == 'textarea' ? "small" : null,
                "description" => null,
                "minlength" => null,
                "maxlength" => null,
                "MinSelect" => null,
                "MaxSelect" => null,
                "min" => null,
                "max" => null,
                "AnniversaryScore" => 0,
                "HappyAnniversary" => null,
                "HappyAnniversaryText" => null,
                "min_max_length_units" => null,
                "include_blank_option" => null,
                "TableID" => null,
                "ImgHeight" => null,
                "ImageWidth" => null,
                "ImgHeight2" => null,
                "ImageWidth2" => null,
                "AcceptMimeType" => null,
                "FileMinCount" => null,
                "Formula" => null,
                "Filters" => null,
                "ColSelected" => null,
                "IsBoxCode" => null,
                "IsUniqueMessage" => null,
                "ParrentFieldCID" => null,
                "ClassName" => null,
                "RequiredMessage" => null,
                "FormDynamicOptionGroupID" => null,
                "options" => $options
            ],
        ];
    }
}
