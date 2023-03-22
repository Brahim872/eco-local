## About DataTable

DataTable for create table using jquery and laravel without any auther library  

## Install

- include file datatable.js
- include files table
- use file trait datatalable


## Install

In the controller we return the columns 


        protected $columns = [
            'name' => [ 
                'title' => 'contact.company_id',
                'select'=>'name',
                'as'=>'name',
                'from'=>'bs_companies',
                'filterKey' => 'bs_companies.name',
                'sortable' => 'bs_companies.name',
                'link' => 'company.show',
                'parameterLink' => 'slug as hide_slug',
            ],
        ],


- <b>Name</b>: it's a key of the chump must be like a fillable
- <b>Title</b>: it's a title whos display in head of table
- <b>Select</b>: element whos must selected  
- <b>as</b>: as
- <b>as</b>: as
- <b>from</b>: table name  
