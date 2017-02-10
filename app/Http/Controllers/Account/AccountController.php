<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $company = $user->company;

        return view('account.index')->with(compact([
            'user', 'company',
        ]));
    }

    /**
     * Get account info.
     *
     * @return mixed
     */
    public function getAccountInfo()
    {
        $user = \Auth::user();
        $company = $user->company;
        $contacts = $company->contacts()->with('groups')->first();

        $companyInfo = [
            'name' => $company->getName(),
            'unp_number'  => (int)$company->getUNPNumber(),
            'description' => $company->getDescription(),
        ];

        $contactsInfo = [
            'address'     => $contacts->getAddress(),
            'website_url' => $contacts->getWebsiteURL(),
            'email'       => $contacts->getCompanyEmail(),
            'skype'       => $contacts->getSkype(),
            'viber'       => $contacts->getViber(),
            'icq'         => $contacts->getICQ(),

            'groups' => [
                'vk' => $contacts->groups->getVkontakteURL(),
                'ok' => $contacts->groups->getOdnoklassnikiURL(),
                'fb' => $contacts->groups->getFacebookURL(),
            ]
        ];

        return Response::json([
            'username' => $user->getName(),
            'company'  => $companyInfo,
            'contacts' => $contactsInfo,
            'success'  => true,
        ], 200);
    }

    /**
     * Update main info of the company and the owner.
     *
     * @param Request $request
     * @return mixed
     */
    public function updateMainInfo(Request $request) {
        $user = \Auth::user();
        $user->setName($request->input('username'));
        $user->save();
        $user->company()->update($request->only(['name', 'description', 'unp_number']));

        return Response::json([
            'messages' => [
                'Основная информация обновлена.'
            ],
            'success'  => true,
        ], 200);
    }

    /**
     * Update socials of the company.
     *
     * @param Request $request
     * @return mixed
     */
    public function updateSocials(Request $request) {
        $user = \Auth::user();
        $user->company->contacts
            ->groups()->update(
                $request->only(['vk_url', 'ok_url', 'fb_url'])
            );

        return Response::json([
            'messages' => [
                'Ссылки на соц.сети обновлены.'
            ],
            'success'  => true,
        ], 200);
    }
}
