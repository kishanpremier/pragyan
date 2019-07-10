<?php

namespace App\Repositories\Backend\subject;
namespace App\Http\Controllers\Backend\Subject;
use App\Repositories\BaseRepository;
use App\Models\Subject\Subject;

/**
 * Class PagesRepository.
 */
class CmsListingPagesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Subject::class;

    /**
     * @param $request
     * @return mixed
     */
    public function getForDataTable()
    {
        $data =  $this->query()
            ->select([
                'class_name',
            ])
            ->get();


        if (!empty($data)) {
            $count = 0;
            foreach ($data as $campaign) {
                $count++;
                $nestedData['name'] = $campaign->name;
                $nestedData['actions'] = "<a><i class='fa fa-trash'></i></a>";
                $value21[] = $nestedData;
            }
        }

        $json_data = array(
            "data" => $value21,
        );

        return $json_data;
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {

        if ($this->query()->where('name', $input['name'])->first()) {
            throw new GeneralException(trans('exceptions.backend.pages.already_exists'));
        }

        $input['created_by'] = auth()->id();

        if ($page = CmsListingModel::create($input)) {
            event(new CmsPageCreated($page));
            return $page;
        }

        throw new GeneralException(trans('exceptions.backend.pages.create_error'));
    }


    public function update($page, array $input)
    {
        if ($this->query()->where('name', $input['name'])->where('id', '==', $page->id)->first()) {
            throw new GeneralException(trans('exceptions.backend.pages.already_exists'));
        }

        // Making extra fields
        //$input['status'] = isset($input['status']) ? 1 : 0;
        $input['updated_by'] = access()->user()->id;


        $up = CmsListingModel::find($page->id);
        $up->update($input);

        if ($up->update($input)) {
            event(new CmsPageUpdated($page));
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.pages.update_error'));
    }


    public function delete($page)
    {
        if ($page->delete()) {
            event(new CmsPageDeleted($page));

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.pages.delete_error'));
    }
}
