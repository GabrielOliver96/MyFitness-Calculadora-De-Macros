@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-2">
        
        <h3 class="text-center mt-5">{{ __('messages.WelcomeMessage') }} {{$user->name}}.</h3>

        <form method="POST">
            @csrf
            <button type="submit" class="btn btn-primary text-white col-sm-12 m-2">{{__('messages.SaveEditions')}}</button>

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Profile') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td>{{ __('messages.Height') }} (cm)</td>
                        <td>
                            <input id="statureId" onkeyup="basalMetabolicRateCalculation()" type="text" maxlength="4" class="form-control col-lg-4" name="stature" value="{{$settingGoal->stature}}" step="any">
                        </td> 
                        <td></td>            
                    </tr>
                    <tr>
                        <td>{{ __('messages.Weight') }} (kg)</td>
                        <td>
                            <input id="weightId" onkeyup="basalMetabolicRateCalculation()" type="number" class="form-control col-lg-4" name="weight" value="{{$settingGoal->weight}}" step="any">
                        </td>      
                        <td></td>    
                    </tr>
                    <tr>
                        <td>{{ __('messages.Gender') }}</td> 
                        <td>
                            <input type="hidden" id="genderHiddenId" value="{{$settingGoal->gender}}"><!-- valor de gender escondido, isso deve ser ajustado no futuro -->
                            <select id="genderId" onchange="basalMetabolicRateCalculation()" name="gender" class="form-control col-lg-4">
                                <option value="Masculino">{{ __('messages.Masculine') }}</option>
                                <option value="Feminino">{{ __('messages.Feminine') }}</option>
                            </select>
                        </td>  
                        <td></td>         
                    </tr>
                    <tr>
                        <td>{{ __('messages.Age') }}</td>
                        <td>
                            <input id="ageId" onkeyup="basalMetabolicRateCalculation()" type="number" class="form-control col-lg-4" name="age" value="{{$settingGoal->age}}" step="any">
                        </td>      
                        <td></td>        
                    </tr>
                    <tr>
                        <td>{{ __('messages.Activity') }}</td>
                        <td>
                            <input type="hidden" id="activityRateFactorHiddenId" value="{{$settingGoal->activity_rate_factor}}"><!-- valor de activityRateFactor escondido, isso deve ser ajustado no futuro -->
                            <select id="activityRateFactorId" onchange="basalMetabolicRateCalculation()" name="activity_rate_factor" class="form-control col-lg-4">
                                <option value="1.2">{{ __('messages.Sedentary') }}</option>
                                <option value="1.38">{{ __('messages.SlightlyActive') }}</option>
                                <option value="1.55">{{ __('messages.ModeratelyActive') }}</option> 
                                <option value="1.72">{{ __('messages.HighlyActive') }}</option>
                                <option value="1.9">{{ __('messages.ExtremelyActive') }}</option>
                            </select>
                            
                        </td>       
                        <td></td>
                    </tr>
                    <tr>
                        <td>{{ __('messages.Objetive') }}</td>
                        <td>
                            <input type="hidden" id="objectiveHiddenId" value="{{$settingGoal->objective}}">
                            <select id="objectiveId" onchange="basalMetabolicRateCalculation()" name="objective" class="form-control col-lg-4">
                                <option value="Perder peso r??pidamente">{{ __('messages.LoseWeightFast') }}</option>
                                <option value="Perder peso lentamente">{{ __('messages.LoseWeightSlowly') }}</option>
                                <option value="Manter o peso">{{ __('messages.KeepWeight') }}</option> 
                                <option value="Aumentar peso lentamente">{{ __('messages.IncreaseWeightSlowly') }}</option>
                                <option value="Aumentar peso r??pidamente">{{ __('messages.GainWeightFast') }}</option>
                            </select>
                        </td>       
                        <td></td>
                    </tr>
                    <tr>

                        <!-- Button trigger modal -->
                        <td>
                            <a style="cursor: pointer;" title="Clique aqui para mais informa????es." data-toggle="modal" data-target="#typeOfDietModal">
                                {{ __('messages.TypeOfDiet') }}
                                <img src="{{ asset('img/icons/interrogation.png') }}" height="22">
                            </a>
                        </td>
                        <td>
                            <input type="hidden" id="typeOfDietHiddenId" value="{{$settingGoal->type_of_diet}}">
                            <select id="typeOfDietId" onchange="basalMetabolicRateCalculation()" name="type_of_diet" value="{{$settingGoal->type_of_diet}}" class="form-control col-lg-4">
                                <option value="Padr??o">{{ __('messages.Pattern') }}</option>
                                <option value="Equilibrado">{{ __('messages.Balanced') }}</option>
                                <option value="Pobre em gorduras">{{ __('messages.LowInFat') }}</option> 
                                <option value="Rico em prote??nas">{{ __('messages.RichInProtein') }}</option>
                                <option value="Cetog??nica">{{ __('messages.Ketogenic') }}</option>
                            </select>
                        </td>
                        <td></td>
                        <!-- Modal -->
                        <div class="modal fade" id="typeOfDietModal" tabindex="-1" role="dialog" aria-labelledby="typeOfDietModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="typeOfDietModalLabel">{{ __('messages.TypeOfDiet') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">{{ __('messages.Pattern') }}</p>
                                            <p class="mx-3">
                                                
                                                <div class="col-md-12">
                                                    <p class="text-danger font-weight-bold">
                                                        {{ __('messages.Carbohydrate') }} 
                                                        {{ __('50%') }}
                                                    </p>
                                                    <p class="text-primary font-weight-bold">
                                                        {{ __('messages.Protein') }} 
                                                        {{ __('20%') }}
                                                    </p>
                                                    <p class="text-warning font-weight-bold">
                                                        {{ __('messages.Fat') }} 
                                                        {{ __('30%') }}
                                                    </p>
                                                </div>

                                            </p>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">{{ __('messages.Balanced') }}</p>
                                            <p class="mx-3">

                                                <div class="col-md-12">
                                                    <p class="text-danger font-weight-bold">
                                                        {{ __('messages.Carbohydrate') }} 
                                                        {{ __('50%') }}
                                                    </p>
                                                    <p class="text-primary font-weight-bold">
                                                        {{ __('messages.Protein') }} 
                                                        {{ __('25%') }}
                                                    </p>
                                                    <p class="text-warning font-weight-bold">
                                                        {{ __('messages.Fat') }} 
                                                        {{ __('25%') }}
                                                    </p>
                                                </div>

                                            </p>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">{{ __('messages.LowInFat') }}</p>
                                            <p class="mx-3">

                                                <div class="col-md-12">
                                                    <p class="text-danger font-weight-bold">
                                                        {{ __('messages.Carbohydrate') }} 
                                                        {{ __('60%') }}
                                                    </p>
                                                    <p class="text-primary font-weight-bold">
                                                        {{ __('messages.Protein') }} 
                                                        {{ __('25%') }}
                                                    </p>
                                                    <p class="text-warning font-weight-bold">
                                                        {{ __('messages.Fat') }} 
                                                        {{ __('15%') }}
                                                    </p>
                                                </div>

                                            </p>
                                        </div>

                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">{{ __('messages.RichInProtein') }}</p>
                                            <p class="mx-3">

                                                <div class="col-md-12">
                                                    <p class="text-danger font-weight-bold">
                                                        {{ __('messages.Carbohydrate') }} 
                                                        {{ __('25%') }}
                                                    </p>
                                                    <p class="text-primary font-weight-bold">
                                                        {{ __('messages.Protein') }} 
                                                        {{ __('40%') }}
                                                    </p>
                                                    <p class="text-warning font-weight-bold">
                                                        {{ __('messages.Fat') }} 
                                                        {{ __('35%') }}
                                                    </p>
                                                </div>

                                            </p>
                                        </div>

                                        <div class="col-lg-12">
                                            <p class="font-weight-bold">{{ __('messages.Ketogenic') }}</p>
                                            <p class="mx-3">

                                                <div class="col-md-12">
                                                    <p class="text-danger font-weight-bold">
                                                        {{ __('messages.Carbohydrate') }} 
                                                        {{ __('5%') }}
                                                    </p>
                                                    <p class="text-primary font-weight-bold">
                                                        {{ __('messages.Protein') }} 
                                                        {{ __('30%') }}
                                                    </p>
                                                    <p class="text-warning font-weight-bold">
                                                        {{ __('messages.Fat') }} 
                                                        {{ __('65%') }}
                                                    </p>
                                                </div>

                                            </p>
                                        </div>
                                    </div>

                                </div>
                                </div>
                            </div>
                        </div>

                    </tr>
                    
                </tbody>

                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Results') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    
                    <tr>
                        <td><img src="{{ asset('img/icons/flame.png') }}" height="22"> {{ __('messages.BasalMetabolicRate') }}</td>
                        <td>
                            <input id="basalMetabolicRateId" type="number" class="form-control col-lg-4" name="basal_metabolic_rate" value="{{$settingGoal->basal_metabolic_rate}}" step="any" readonly>
                        </td>         
                        <td></td>    
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/icons/imc.png') }}" height="22"> {{ __('messages.BodyMassIndex') }}</td>
                        <td>
                            <input id="imcId" type="number" class="form-control col-lg-4" name="imc" value="{{$settingGoal->imc}}" step="any" readonly>
                        </td>     
                        <td></td>       
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/icons/water.png') }}" height="22"> {{ __('messages.WaterRequirements') }}</td>
                        <td>
                            <input id="waterId" type="number" class="form-control col-lg-4" name="water" value="{{$settingGoal->water}}" step="any" readonly>
                        </td>     
                        <td></td>    
                    </tr>
                    
                </tbody>

                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.DailyCaloricRequirements&MacroNutrients') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    
                    <tr>
                        <td class="font-weight-bold"><img src="{{ asset('img/icons/flame.png') }}" height="22"> {{ __('messages.Calories') }}</td>
                        <td>
                            <input id="dailyCaloriesId" type="number" class="form-control col-lg-4" name="daily_calories" value="{{$settingGoal->daily_calories}}" step="any" readonly>
                        </th>           
                    </tr>
                    <tr>
                        <td class="text-danger font-weight-bold"><img src="{{ asset('img/icons/carboidrato.png') }}" height="22"> {{ __('messages.Carbohydrate') }}</td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyCarbohydrateId" type="number" class="form-control col-lg-4" name="daily_carbohydrate" value="{{$settingGoal->daily_carbohydrate}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td> 
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyCarbohydrateKcalId" type="number" class="form-control col-lg-4" name="daily_carbohydrate_kcal" value="{{$settingGoal->daily_carbohydrate_kcal}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </td> 
                    </tr>
                    <tr>
                        <td class="text-primary font-weight-bold"><img src="{{ asset('img/icons/proteina.png') }}" height="22"> {{ __('messages.Protein') }}</td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyProteinId" type="number" class="form-control col-lg-4" name="daily_protein" value="{{$settingGoal->daily_protein}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </th>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyProteinKcalId" type="number" class="form-control col-lg-4" name="daily_protein_kcal" value="{{$settingGoal->daily_protein_kcal}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </th>                     
                    </tr>
                    <tr>
                        <td class="text-warning font-weight-bold"><img src="{{ asset('img/icons/gordura.png') }}" height="22"> {{ __('messages.Fat') }}</td>
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyFatId" type="number" class="form-control col-lg-4" name="daily_fat" value="{{$settingGoal->daily_fat}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">g</span>
                                </div>
                            </div>
                        </td> 
                        <td>
                            <div class="input-group mb-3">
                                <input id="dailyFatKcalId" type="number" class="form-control col-lg-4" name="daily_fat_kcal" value="{{$settingGoal->daily_fat_kcal}}" step="any" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Kcal</span>
                                </div>
                            </div>
                        </td>            
                    </tr>
                    
                </tbody>

                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.MyContent') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><img src="{{ asset('img/icons/maca.png') }}" height="22"> {{ __('messages.MyFoods') }}</td>
                        <td><a href="{{route('allFoodsView')}}" class="text-decoration-none">Abrir<img src="{{ asset('img/icons/seta-direita.png') }}" class="animate__animated animate__slideOutRight animate__infinite	infinite animate__slow" height="22"></a></td> 
                        <td></td>
                    </tr>
                    <tr>
                        <td><img src="{{ asset('img/icons/chapeu-de-chef.png') }}" height="22"> {{ __('messages.MyRecipes') }}</td>
                        <td>Abrir<img src="{{ asset('img/icons/seta-direita.png') }}" class="animate__animated animate__slideOutRight animate__infinite	infinite animate__slow" height="22"></td>    
                        <td></td>            
                    </tr>
                    
                </tbody>
            </table>

        </form>

    </div>

</div>


<script src="{{asset('js/tmb.js')}}"></script>
<script src="{{asset('js/inputMasks.js')}}"></script>
<script src="{{asset('js/masks.js')}}"></script>

@endsection