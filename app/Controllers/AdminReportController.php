<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminReportController extends BaseController
{
    private $OrderModel;

    public function __construct()
    {
        $this->OrderModel = new \App\Models\OrderModel();
        helper("form");
    }

    public function report_orders()
    {
        return view('admin/report_orders');
    }

    public function report_orders_print()
    {
        $period = $this->request->getGet('period');

        $months = ([
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ]);

        $rows = $this->OrderModel
            ->select([
                'invoices.name',
                'invoices.order_date',
                'orders.qty',
                'orders.product_name',
                'orders.variant_name',
                'orders.price',
            ])
            ->join('invoices', 'orders.invoice_id = invoices.id');

        if ($period === "datePeriod") {
            $date = $this->request->getGet("date");

            $title = "Pada Tanggal " . date("d-m-Y", strtotime($date));

            $rows->where("invoices.order_date", $date);
        } elseif ($period === "dateRangePeriod") {
            $date_begin = $this->request->getGet("date_begin");
            $date_end = $this->request->getGet("date_end");

            $rows->where("invoices.order_date >=", $date_begin);
            $rows->where("invoices.order_date <=", $date_end);

            $title = "Antara Tanggal " . date("d-m-Y", strtotime($date_begin)) . " Sampai Tanggal " . date("d-m-Y", strtotime($date_end));
        } elseif ($period === "monthPeriod") {
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");

            $rows->where("invoices.order_date >=", $year . "-" . $month . "-01");
            $rows->where("invoices.order_date <=", $year . "-" . $month . "-31");

            $title = "Pada Bulan " . $months[($month - 1)] . " Tahun " . $year;
        } elseif ($period === "yearPeriod") {
            $year = $this->request->getGet("year");

            $rows->where("invoices.order_date >=", $year . "-01-01");
            $rows->where("invoices.order_date <=", $year . "-12-31");

            $title = "Pada Tahun " . $year;
        }

        $rows->orderBy("invoices.id", "desc");
        $rows = $rows->get()->getResultObject();

        $data = ([
            "rows"  => $rows,
            "title" => $title,
        ]);
        return view("admin/report_orders_print", $data);
    }
}
