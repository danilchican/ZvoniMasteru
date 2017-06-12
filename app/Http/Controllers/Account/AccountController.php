<?php

namespace App\Http\Controllers\Account;

use App\Http\Helpers\ImageService;
use App\Http\Requests\Account\UpdateContactsRequest;
use App\Http\Requests\Account\UpdateMainSettingsRequest;
use App\Http\Requests\Account\UpdateSocialsRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UploadLogoRequest;
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
        $countReviews = $company->reviews()->count();

        return view('account.index')->with(compact([
            'user', 'company', 'countReviews',
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
            'slug' => $company->getSlug(),
            'unp_number'  => (int)$company->getUNPNumber(),
            'description' => $company->getDescription(),
            'logo_url' => $company->getLogo(),
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
     * @param UpdateMainSettingsRequest $request
     * @return mixed
     */
    public function updateMainInfo(UpdateMainSettingsRequest $request) {
        $user = \Auth::user();
        $user->setName($request->input('username'));
        $user->save();
        $user->company()->update($request->only(['name', 'slug', 'description', 'unp_number']));

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
     * @param UpdateSocialsRequest $request
     * @return mixed
     */
    public function updateSocials(UpdateSocialsRequest $request) {
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

    /**
     * Update contacts of the company.
     *
     * @param UpdateContactsRequest $request
     * @return mixed
     */
    public function updateContacts(UpdateContactsRequest $request) {
        $user = \Auth::user();
        $user->company->contacts()->update(
                $request->only(['address', 'website_url', 'icq', 'viber', 'skype', 'email'])
            );

        return Response::json([
            'messages' => [
                'Контактные данные обновлены.'
            ],
            'success'  => true,
        ], 200);
    }

    /**
     * Upload new logo for a company.
     *
     * @param UploadLogoRequest $request
     * @return mixed
     */
    public function uploadLogo(UploadLogoRequest $request)
    {
        $company = \Auth::user()->company;

        if($company->hasLogo()) {
            $oldLogo = $company->getLogo();

            if(!ImageService::removeThumbnail($oldLogo)) {
                return Response::json([
                    'errors' => [
                        'Невозможно удалить предыдущий логотип.'
                    ],
                    'success'  => false,
                ], 422);
            }
        }

        $logo = $request->file('logo');
        $path = ImageService::saveThumbnail($logo, 200);

        $company->setLogo($path);
        $company->save();

        return Response::json([
            'messages' => [
                'Логотип обновлён.'
            ],
            'logo_url' => $path,
            'success'  => true,
        ], 200);
    }
}
