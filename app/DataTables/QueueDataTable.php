<?php

namespace App\DataTables;

use App\Models; 
use Yajra\Datatables\Services\DataTable;
use Yajra\Datatables\Datatables;
class QueueDataTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        
       $queue = $this->query();
      
        return Datatables::of($queue)
                        
                        ->addColumn('ACTION', function ($patient) {
                            return "<a href=\"show_history/$patient->id/id\" class=\"\"><i title='Click to view history' style='' class=\"sm-icon material-icons\">pageview</i></a>
<a href=\"add_diagnosis/$patient->id/id\" class=\"\"><i title='Click to add diagnosis' class=\"sm-icon material-icons\">local_hospital</i></a>
<a href=\"add_prescription/$patient->id/id\" class=\"\"><i title='Click to add prescriptions' class=\"sm-icon material-icons\">local_hospital</i></a>";
                        })
                        ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
       $date=date("Y-m-d");
       $doctor= \Auth::user()->id;
       $queue = \App\Models\QueueModel::query()->where('DATE(DATE)',$date)
               ->where('FOR_DOCTOR',$doctor);

       return $this->applyScopes($queue);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                   ->parameters([
            'dom' => 'Bfrtip',
            'buttons' => ['csv', 'excel', 'pdf', 'print', 'reset', 'reload'],
        ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'ID',
            // add your columns
            'PATIENT',
            'TEST_RECOM1',
            'TEST_RECOM2',
            'TEST_RECOM3',
            'TEST_RECOM4',
            'DRUG_RECOM1',
            'DRUG_RECOM2',
            'DRUG_RECOM3',
            'DRUG_RECOM4',
            'PUSHED_BY',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'queue';
    }
}
