<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Generate PDF report from MySQL database using Codeigniter</title>
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width:
			100%;
		}
		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}
		tr:nth-child(even) {
			background-color: #dddddd;
		}
	</style>
</head>
<body>
	<div style="margin: 10px 0 0 10px;width: 600px">
		<h3>Sales Information</h3>
<a href="https://sourceforge.net/projects/tcpdf/">download pdf library</a><br>
<a href="https://www.roytuts.com/generate-html-table-from-mysql-database-using-codeigniter/">then follow this first for make table</a><br>
<a href="https://www.roytuts.com/generate-pdf-report-from-mysql-database-using-codeigniter/">then follow this second link to pdf code</a><br>
		<?php			
		echo anchor('product/generate_pdf', 'Generate PDF Report');
			$this->table->set_heading('Product Id', 'Price', 'Sale Price', 'Sales Count', 'Sale Date');
			
			foreach ($salesinfo as $sf):
				$this->table->add_row($sf->id, $sf->price, $sf->sale_price, $sf->sales_count, $sf->sale_date);
			endforeach;
			
			echo $this->table->generate();
		?>
		
	</div>
</body>
</html>