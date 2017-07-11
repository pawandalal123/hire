<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;

trait ValidationTrait {

    public function validatordiscusion(array $data)
    {
        $messsages = [
        'title.required'=>'You cant leave title field empty',
        'description.required'=>'Please enter description'];
       

    $rules = [
        'title'=>'required|max:255',
        'description'=>'required|not_in:0'
    ];

    return Validator::make($data, $rules,$messsages);
       
    }

    public function postdiscussion(Request $request)
    {
        $validator = $this->validatordiscusion($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->discussion->saveform($request);
    }
    //////////////////// validate articles/////////

    protected function validator(array $data)
    {
        $messsages = [
        'title.required'=>'You cant leave title field empty',
        'category.required'=>'Please select category',
        'subcategory.required'=>'Please select subcategory',
        'articlefile.mimes'=>'Please select valid file'];
       

        $rules = [
            'title'=>'required|max:255',
            'category'=>'required|not_in:0',
            'subcategory' => 'required|not_in:0',
            'articlefile' => 'mimes:jpeg,png,bmp,gif,jpg'
        ];

      return Validator::make($data, $rules,$messsages);
       
    }

    public function postarticle(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->articles->savearticle($request);
    }

   
     ///////////// validation for edit profile////
    protected function validateprofile(array $data)
    {
        $messsages = [
        'mobile.required'=>'Please enter mobile number',
        'mobile.numeric'=>'Please enter only number',
        'first_name.required'=>'Please enter first name',
        'dob.date'=>'Please enter valid date',
        'profileimage.mimes'=>'Please select valid file'];
       

        $rules = [
            'mobile'=>'required|numeric',
            'gender'=>'required',
            'first_name'=>'required|max:255',
            'dob' => 'date|date_format:Y-m-d',
            'profileimage' => 'mimes:jpeg,png,bmp,gif,jpg'

        ];
        return Validator::make($data, $rules,$messsages);
    }
    //////////////save editprofil////
    public function userbasci_info(Request $request)
    {
        $validator = $this->validateprofile($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->usersInterface->updateuserdetails($request);
    }

    /////////// make subuser///////////
      ///////////// validation for edit profile////
    protected function validatesubuser(array $data)
    {
        $messsages = [
        'mobile.required'=>'Please enter mobile number',
        'mobile.numeric'=>'Please enter only number',
        'email.required'=>'Please enter first name',
        'password.required'=>'Please enter password',
        'username.required'=>'Please enter name'];
       

        $rules = [
            'mobile'=>'required|numeric',
            'username'=>'required',
            'email'=>'required|email|max:255|unique:users',
            'password' => 'required|min:6'

        ];
        return Validator::make($data, $rules,$messsages);
    }
    public function makesubuser(Request $request)
    {
        $validator = $this->validatesubuser($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->usersInterface->createsubuser($request);
    }

    /////////////post invitation///
   protected function validatorinvite(array $data)
    {
        $messsages = [
        'discussion_name.required'=>'Select discussion ',
        'name.required'=>'Please  enter name',
        'email.required'=>'Please enter email'];
       

    $rules = [
        'discussion_name'=>'required|not_in:0',
        'name' => 'required',
        'email' => 'required|email'
    ];

    return Validator::make($data, $rules,$messsages);
       
    }
    public function sendinvite(Request $request)
    {
        $validator = $this->validatorinvite($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
    }


    protected function validatorotherinfo(array $data)
    {
        $messsages = [
        'skills.required'=>'Please enter skills',
        'jobcategory.required'=>'Please select functional area',
        'industry.required'=>'Please select industry',
        'resumefile.mimes'=>'Please select valid file'];
       

    $rules = [
        'skills'=>'required',
        'jobcategory'=>'required',
        'industry'=>'required',
        'resumefile' => 'mimes:jpeg,png,bmp,gif,jpg'
    ];

    return Validator::make($data, $rules,$messsages);
       
    }
    public function jobprefrence(Request $request)
    {
        $validator = $this->validatorotherinfo($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
    }

    protected function validatorcompany(array $data)
    {
        // dd($data);
        $messsages = [
        'companyname.required'=>'Please enter company name',
        'contact.required'=>'Please select contact number',
        'companylogo.mimes'=>'Please select valid file'];
       

    $rules = [
        'companyname'=>'required',
        'contact' => 'required|numeric',
        'companylogo' => 'mimes:jpeg,bmp,png,jpg',
        'industry'=>'required|numeric|not_in:0',
    ];

    return Validator::make($data, $rules,$messsages);
       
    }


    ////////////////// save news//////////


       //////////////////// validate news/////////

    protected function validatornews(array $data)
    {
        $messsages = [
        'title.required'=>'You cant leave title field empty',
          'description.required'=>'You cant leave description field empty',
        
        'articlefile.mimes'=>'Please select valid file'];
       

    $rules = [
        'title'=>'required|max:255',
        'description'=>'required',
        'articlefile' => 'mimes:jpeg,png,bmp,gif,jpg'
    ];

    return Validator::make($data, $rules,$messsages);
       
    }
    public function savenews(Request $request)
    {
        $validator = $this->validatornews($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->postnews->savepostnews($request);
    }

    ///////////////validation job post///
       //////////////////// validate news/////////

    protected function validattionjob(array $data)
    {
        $messsages = [
        'openings.required'=>'Please enter number of openings',
        'description.required'=>'Please enter job description',
        'projectskills.required'=>'Please enter project skills',
        'jobquality.required'=>'Please enter job quality',
         'contactemail.required'=>'Please enter client email',

        'comphiring.required'=>'Enter company hiring name'];
       

    $rules = [
        'openings'=>'required|numeric',
        'description'=>'required',
        'aboutcompnay'=>'required',
        'comphiring' => 'required',
        'projectskills'=>'required',
        'jobquality'=>'required',
        'country'=>'required|not_in:0',
        'state'=>'required|not_in:0',
        'city'=>'required|not_in:0',
        'industry'=>'required',
        'contactemail'=>'required|email',
    ];

    return Validator::make($data, $rules,$messsages);
       
    }
    public function jobvalidation(Request $request)
    {
        $validator = $this->validattionjob($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
    }
    ///////////// validate employment form/////
   
    protected function validateemp(array $data)
    {
        $messsages = [
        'Designation.required'=>'Please enter designation',
        
        'company.required'=>'Please enter company name'];
       

        $rules = [
            'Designation'=>'required',
            'job_profile'=>'required',
            'company'=>'required'

        ];
        return Validator::make($data, $rules,$messsages);
    }


      ///////////// validate project form/////
   
    protected function validateproject(array $data)
    {
        $messsages = [
      
        'projectcmp.required'=>'Please select company name',
        'projectcmp.required'=>'Please select company name',
        'projectname.required'=>'Please enter project name'];
       

        $rules = [
            'projectcmp'=>'required|not_in:0',
            'projectname'=>'required',
            'projectloc'=>'required',
            'industry'=>'required',
            'projectnature'=>'required'

        ];
        return Validator::make($data, $rules,$messsages);
    }

    /////////// validation cradibilry////
     ///////////// validation for cradibilry category////
    protected function validatecredibiltycat(array $data)
    {
        $messsages = [
        'name.required' => 'The field name is required'];
       

        $rules = [
            'name' => 'required|unique:credibility_categories'

        ];
        return Validator::make($data, $rules,$messsages);
    }

    public function credibilitycat(Request $request)
    {
        $validator = $this->validatecredibiltycat($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
    }

    ///////////// validation for cradibilry factor////
    protected function validatecredibiltyfactor(array $data)
    {
        $messsages = [
        'category.required' => 'The field name is required',
        'point.required' => 'The point required',
        'name.required' => 'The field name is required'];
       

        $rules = [
            'category' => 'required|not_in:0',
            'point'=>'required|numeric',
            'name' => 'required|unique:credibility_categories'

        ];
        return Validator::make($data, $rules,$messsages);
    }

    public function credibiltyfactor(Request $request)
    {
        $validator = $this->validatecredibiltyfactor($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
    }


    protected function validatedept(array $data)
    {
        $messsages = [
        'departmentname.required'=>'Please enter designation'];
       

        $rules = [
            'departmentname'=>'required'

        ];
        return Validator::make($data, $rules,$messsages);
    }

     protected function validateemployee(array $data)
     {
        $messsages = [
        'empdepartment.required'=>'Please enter designation',
        'employname.required'=>'Please enter employee name'];
       

        $rules = [
            'empdepartment'=>'required|not_in:0',
            'employname'=>'required'

        ];
        return Validator::make($data, $rules,$messsages);
     }
    
}