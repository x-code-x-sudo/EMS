<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Include Tempus Dominus DateTime Picker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css">
<!-- Include Moment.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include Tempus Dominus DateTime Picker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>



@extends('dashboard.layouts.default')

@section('content')
    <x-panel title="Регистр ОКС в СЭМП">

        <form action="{{ route('acs.add') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="branch">Выбрать отделение</label>
                        <select class="form-control" id="branch" name="branch_id">
                            <!-- Add options for department -->
                            <option value="" hidden>Выберите отделение</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group ml-auto">
                        <label for="history_disease">Номер Истории Болезни</label>
                        <input type="text" class="form-control" id="history_disease" name="history_disease">
                        @error('history_disease')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="full_name">Пациент ФИО</label>
                <input type="text" class="form-control" id="full_name" name="full_name">
                @error('full_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="hospitalization_date">Дата и время поступления</label>
                        <div class="input-group date" id="hospitalization_date_picker" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#hospitalization_date_picker" id="hospitalization_date" name="hospitalization_date">
                            <div class="input-group-append" data-target="#hospitalization_date_picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        @error('hospitalization_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="discharge_date">Дата выписки</label>
                        <div class="input-group date" id="discharge_date_picker" data-target-input="nearest">
                            <input type="text" class="form-control" data-target="#discharge_date_picker" id="discharge_date" name="discharge_date">
                            <div class="input-group-append" data-target="#discharge_date_picker" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        @error('discharge_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="hospitalization_channels"><b>Канал госпитализации</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hospitalization_channels" id="hospitalizationOption1" value="Скорая">
                    <label class="form-check-label" for="hospitalizationOption1">Скорая</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hospitalization_channels" id="hospitalizationOption2" value="Самотек">
                    <label class="form-check-label" for="hospitalizationOption2">Самотек</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hospitalization_channels" id="hospitalizationOption3" value="Направление">
                    <label class="form-check-label" for="hospitalizationOption3">Направление</label>
                </div>
                @error('hospitalization_channels')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="treatment_result"><b>Исход лечения</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="treatment_result" id="outcomeOption1" value="Выписан">
                    <label class="form-check-label" for="outcomeOption1">Выписан</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="treatment_result" id="outcomeOption2" value="Летальный исход">
                    <label class="form-check-label" for="outcomeOption2">Летальный исход</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="treatment_result" id="outcomeOption3" value="Выписан в тяжелом состоянии">
                    <label class="form-check-label" for="outcomeOption3">Выписан в тяжелом состоянии</label>
                </div>
                @error('treatment_result')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="final_result"><b>Исход</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="final_result" id="overallOption1" value="ОИМ с Q">
                    <label class="form-check-label" for="overallOption1">ОИМ с Q</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="final_result" id="overallOption2" value="Оим без Q">
                    <label class="form-check-label" for="overallOption2">Оим без Q</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="final_result" id="overallOption3" value="Прогрессирующая стенокардия">
                    <label class="form-check-label" for="overallOption3">Прогрессирующая стенокардия</label>
                </div>
                @error('final_result')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="anginal_attack_date"><b>Срок ангинального приступа при поступлении</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anginal_attack_date" id="anginalOption1" value="до 6ч.">
                    <label class="form-check-label" for="anginalOption1">до 6ч.</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anginal_attack_date" id="anginalOption2" value="6-12ч.">
                    <label class="form-check-label" for="anginalOption2">6-12ч.</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anginal_attack_date" id="anginalOption3" value="позже 12ч.">
                    <label class="form-check-label" for="anginalOption3">позже 12ч.</label>
                </div>
                @error('anginal_attack_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="cta_invasive_angiography"><b>Показана экстренная ЧКВ/инвазивная ангиография:</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="cta_invasive_angiography" id="urgentOption1" value="Да">
                    <label class="form-check-label" for="urgentOption1">Да</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="cta_invasive_angiography" id="urgentOption2" value="Нет">
                    <label class="form-check-label" for="urgentOption2">Нет</label>
                </div>
                @error('cta_invasive_angiography')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="cta_90min"><b>Экстренная ЧКВ выполнена в течение 90 минут:</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="cta_90min" id="cta_90minOption1" value="Да">
                    <label class="form-check-label" for="cta_90minOption1">Да</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="cta_90min" id="cta_90minOption2" value="Нет">
                    <label class="form-check-label" for="cta_90minOption2">Нет</label>
                </div>
                @error('cta_90min')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="deferred_cta_invasive"><b>Показана отсроченная ЧКВ выполнена/инвазивная ангиография:</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="deferred_cta_invasive" id="deferred_cta_invasiveOption1" value="Да">
                    <label class="form-check-label" for="deferred_cta_invasiveOption1">Да</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="deferred_cta_invasive" id="deferred_cta_invasiveOption2" value="Нет">
                    <label class="form-check-label" for="deferred_cta_invasiveOption2">Нет</label>
                </div>
                @error('deferred_cta_invasive')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="deferred_cta_completed"><b>Отсроченная ЧКВ выполнена:</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="deferred_cta_completed" id="deferred_cta_completedOption1" value="Да">
                    <label class="form-check-label" for="deferred_cta_completedOption1">Да</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="deferred_cta_completed" id="deferred_cta_completedOption2" value="Нет">
                    <label class="form-check-label" for="deferred_cta_completedOption2">Нет</label>
                </div>
                @error('deferred_cta_completed')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="reasons_not_performing_cta"><b>Если не проведена ЧКВ, отметьте причину:</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="reasons_not_performing_cta" id="reasons_not_performing_ctaOption1" value="медицинские противопоказания">
                    <label class="form-check-label" for="reasons_not_performing_ctaOption1">медицинские противопоказания</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="reasons_not_performing_cta" id="reasons_not_performing_ctaOption2" value="отсутствие специалиста">
                    <label class="form-check-label" for="reasons_not_performing_ctaOption2">отсутствие специалиста</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="reasons_not_performing_cta" id="reasons_not_performing_ctaOption3" value="отсутствие оборудования">
                    <label class="form-check-label" for="reasons_not_performing_ctaOption3">отсутствие оборудования</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="reasons_not_performing_cta" id="reasons_not_performing_ctaOption4" value="занятость оборудования">
                    <label class="form-check-label" for="reasons_not_performing_ctaOption4">занятость оборудования</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="reasons_not_performing_cta" id="reasons_not_performing_ctaOption5" value="отсутствие расходных материалов">
                    <label class="form-check-label" for="reasons_not_performing_ctaOption5">отсутствие расходных материалов</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="reasons_not_performing_cta" id="reasons_not_performing_ctaOption6" value="отказ больного">
                    <label class="form-check-label" for="reasons_not_performing_ctaOption6">отказ больного</label>
                </div>
                @error('reasons_not_performing_cta')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="thrombolytic_therapy"><b>Показана ли тромболитическая терапия (ТЛТ):</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thrombolytic_therapy" id="thrombolytic_therapyOption1" value="Да">
                    <label class="form-check-label" for="thrombolytic_therapyOption1">Да</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thrombolytic_therapy" id="thrombolytic_therapyOption2" value="Нет">
                    <label class="form-check-label" for="thrombolytic_therapyOption2">Нет</label>
                </div>
                @error('thrombolytic_therapy')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="thrombolytic_therapy_administered"><b>Если «Да», то проведена ли ТЛТ:</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thrombolytic_therapy_administered" id="thrombolytic_therapy_administeredOption1" value="Да">
                    <label class="form-check-label" for="thrombolytic_therapy_administeredOption1">Да</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thrombolytic_therapy_administered" id="thrombolytic_therapy_administeredOption2" value="Нет">
                    <label class="form-check-label" for="thrombolytic_therapy_administeredOption2">Нет</label>
                </div>
                @error('thrombolytic_therapy_administered')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <div class="form-group">
                <label for="not_administering_tlt"><b>Если «НЕТ», отметьте причину:</b></label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="not_administering_tlt" id="not_administering_tltOption1" value="медицинские противопоказания">
                    <label class="form-check-label" for="not_administering_tltOption1">медицинские противопоказания</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="not_administering_tlt" id="not_administering_tltOption2" value="отсутствие препарата">
                    <label class="form-check-label" for="not_administering_tltOption2">отсутствие препарата</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="not_administering_tlt" id="not_administering_tltOption3" value="отказ больного">
                    <label class="form-check-label" for="not_administering_tltOption3">отказ больного</label>
                </div>
                @error('not_administering_tlt')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr>
            <span><b> * Во время госпитализации больному (-ой):</b><span></span> <br><br>
                <div class="form-group">
                    <label for="ecg_during_hospitalization"><b>Проведено ЭКГ</b></label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ecg_during_hospitalization" id="ecg_during_hospitalizationOption1" value="Да">
                            <label class="form-check-label" for="ecg_during_hospitalizationOption1">Да</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="ecg_during_hospitalization" id="ecg_during_hospitalizationOption2" value="Нет">
                            <label class="form-check-label" for="ecg_during_hospitalizationOption1">Нет</label>
                        </div>
                        @error('ecg_during_hospitalization')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="st_segment"><b>Если проведено ЭКГ, СТ сегмента повышен:</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="st_segment" id="st_segmentOption1"
                            value="Да">
                        <label class="form-check-label" for="st_segmentOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="st_segment" id="st_segmentOption2"
                            value="Нет">
                        <label class="form-check-label" for="st_segmentOption2">Нет</label>
                    </div>
                    @error('st_segment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="echocardiogram"><b>Проведено ЭхоКГ (с оценкой ФВ ЛЖ%):</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="echocardiogram" id="echocardiogramOption1"
                            value="Да">
                        <label class="form-check-label" for="echocardiogramOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="echocardiogram" id="echocardiogramOption2"
                            value="Нет">
                        <label class="form-check-label" for="echocardiogramOption2">Нет</label>
                    </div>
                    @error('echocardiogram')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="first_measurement"><b>Если «Да», то время первого измерения ФВ ЛЖ%</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="first_measurement" id="first_measurementOption1"
                            value="≤3 сутки">
                        <label class="form-check-label" for="first_measurementOption1">≤3 сутки</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="first_measurement" id="first_measurementOption2"
                            value=">3 суток">
                        <label class="form-check-label" for="first_measurementOption2">>3 суток</label>
                    </div>
                    @error('first_measurement')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="cholestero_levels"><b>Проведены анализы на ЛПНП</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cholestero_levels" id="cholestero_levelsOption1"
                            value="Да">
                        <label class="form-check-label" for="cholestero_levelsOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="cholestero_levels" id="cholestero_levelsOption2"
                            value="Нет">
                        <label class="form-check-label" for="cholestero_levelsOption2">Нет</label>
                    </div>
                    @error('cholestero_levels')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="aptt"><b>Проведены анализ на АЧТВ (25-36сек)</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="aptt" id="apttOption1"
                            value="Да">
                        <label class="form-check-label" for="apttOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="aptt" id="apttOption2"
                            value="Нет">
                        <label class="form-check-label" for="apttOption2">Нет</label>
                    </div>
                    @error('aptt')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="anticoagulant"><b>Проведена антикоагулянтная терапия:</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="anticoagulant" id="anticoagulantOption1"
                            value="Да">
                        <label class="form-check-label" for="anticoagulantOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="anticoagulant" id="anticoagulantOption2"
                            value="Нет">
                        <label class="form-check-label" for="anticoagulantOption2">Нет</label>
                    </div>
                    @error('anticoagulant')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="aspirin"><b>Принимал аспирин:</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="aspirin" id="aspirinOption1"
                            value="Да">
                        <label class="form-check-label" for="aspirinOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="aspirin" id="aspirinOption2"
                            value="Нет">
                        <label class="form-check-label" for="aspirinOption2">Нет</label>
                    </div>
                    @error('aspirin')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="p2y12"><b>Принимал ингибиторы P2Y12:</b></label><br>
                    <span>(prasugrel, ticagrelor, или clopidogrel)</span><br><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="p2y12" id="p2y12Option1"
                            value="Да">
                        <label class="form-check-label" for="p2y12Option1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="p2y12" id="p2y12Option2"
                            value="Нет">
                        <label class="form-check-label" for="p2y12Option2">Нет</label>
                    </div>
                    @error('p2y12')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="high_intensity_statins"><b>Принимал статины высокой интенсивности:</b></label><br>
                    <span>(atorvastatin ⩾40 mg or rosuvastatin ⩾20 mg)</span><br><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="high_intensity_statins" id="high_intensity_statinsOption1" value="Да">
                        <label class="form-check-label" for="high_intensity_statinsOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="high_intensity_statins" id="high_intensity_statinsOption2" value="Нет">
                        <label class="form-check-label" for="high_intensity_statinsOption2">Нет</label>
                    </div>
                    @error('high_intensity_statins')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="ACE_inhibitors_ARBs"><b>Принимал ингибиторы АПФ или БРАII:</b></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ACE_inhibitors_ARBs" id="ACE_inhibitors_ARBsOption1" value="Да">
                        <label class="form-check-label" for="ACE_inhibitors_ARBsOption1">Да</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="ACE_inhibitors_ARBs" id="ACE_inhibitors_ARBsOption2" value="Нет">
                        <label class="form-check-label" for="ACE_inhibitors_ARBsOption2">Нет</label>
                    </div>
                    @error('ACE_inhibitors_ARBs')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <hr>
                <div class="form-group">
                    <label for="physician_full_name">ФИО лечащего врача:</label>
                    <input type="text" class="form-control" id="physician_full_name" name="physician_full_name">
                    @error('physician_full_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stat_department_full_name">ФИО специалиста стат.отдела:</label>
                    <input type="text" class="form-control" id="stat_department_full_name"
                        name="stat_department_full_name">
                    @error('stat_department_full_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </x-panel>
@endsection


<script>
    $(document).ready(function() {
        $('#hospitalization_date_picker').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            // Rest of the options...
        }).on("change.datetimepicker", function (e) {
            var formattedDate = moment(e.date).format('DD.MM.YYYY HH:mm');
            $(this).find('input').val(formattedDate);
        });

        $('#discharge_date_picker').datetimepicker({
            format: 'DD.MM.YYYY HH:mm',
            // Rest of the options...
        }).on("change.datetimepicker", function (e) {
            var formattedDate = moment(e.date).format('DD.MM.YYYY HH:mm');
            $(this).find('input').val(formattedDate);
        });

        // Set the locale to en for 24-hour format
        moment.locale('en');
    });
</script>











