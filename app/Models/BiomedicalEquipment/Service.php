<?php

namespace App\Models\BiomedicalEquipment;

use App\Traits\Models\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory, ModelTrait;

    const PATHOLOGY = 1;
    const PRE_TRANSFUSIONAL_MANAGEMENT = 2;
    const DIAGNOSTIC_IMAGES_NON_IONIZING = 3;
    const DIAGNOSTIC_IMAGES_IONIZING = 4;
    const VASCULAR_DIAGNOSIS = 5;
    const PHONE_AUDIOLOGY_AND_OR_LANGUAGE_THERAPY = 6;
    const PHYSIOTHERAPY = 7;
    const RESPIRATORY_THERAPY = 8;
    const OCCUPATIONAL_THERAPY = 9;
    const PHARMACEUTICAL_SERVICE = 10;
    const RADIOTHERAPY = 11;
    const CHEMOTHERAPY = 12;
    const CLINICAL_LABORATORY = 13;
    const MEDICALIZED_CARE_TRANSPORTATION = 14;
    const BASIC_ASSISTANCE_TRANSPORTATION = 15;
    const EMERGENCIES = 16;
    const BIRTH_CARE = 17;
    const OPHTHALMOLOGY = 18;
    const ORTHOPEDIC_AND_OR_TRAUMATOLOGY = 19;
    const OTORHINOLARYNGOLOGY = 20;
    const PEDIATRICS = 21;
    const PSYCHOLOGY = 22;
    const PSYCHIATRY = 23;
    const RHEUMATOLOGY = 24;
    const TOXICOLOGY = 25;
    const UROLOGY = 26;
    const OTHER_SPECIALTY_CONSULTATIONS = 27;
    const PEDIATRIC_CARDIOLOGY = 28;
    const HAND_SURGERY = 29;
    const BREAST_SURGERY_AND_SOFT_TISSUE_TUMORS = 30;
   
}
