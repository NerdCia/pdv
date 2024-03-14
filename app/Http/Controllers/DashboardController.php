<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();

        // Produtos com menos de 10 em estoque
        $productsWithLessThan10InStock = DB::table('products')
            ->where('quantity', '<', '10')
            ->paginate(
                $perPage = 5,
                $columns = ['*'],
                $pageName = 'productsWithLessThan10InStock'
            );

        // Últimas 5 vendas
        $lastSales = Sale::all()->take(5);

        // Dados dos gráficos de linha
        $saleProductsData = SaleProduct::select([
            DB::raw('DATE_FORMAT(sale_products.created_at, "%Y/%m") as saleDate'),
            DB::raw('SUM(sale_products.amount) as grossRevenue'),
            DB::raw('COUNT(sale_products.id_sale) as saleQuantity'),
            DB::raw('SUM(sale_products.amount) - SUM(sale_products.expense_product * sale_products.quantity) as profit'),
        ])
            ->groupBy('saleDate')
            ->orderBy('saleDate', 'asc')
            ->get();

        foreach ($saleProductsData as $saleProducts) {
            $saleDates[] = '"' . $saleProducts->saleDate . '"';
            $grossRevenues[] = $saleProducts->grossRevenue;
            $salesQuantity[] = $saleProducts->saleQuantity;
            $profits[] = $saleProducts->profit;
            $profitMargins[] = number_format(($saleProducts->profit / $saleProducts->grossRevenue) * 100, 2);
        }

        // Faturamento bruto total de todos os períodos
        $grossRevenueTotal = array_sum($grossRevenues); 

        // Quantidade de vendas total de todos os períodos 
        $salesQuantityTotal = array_sum($salesQuantity);

        // Lucro total em todos os períodos
        $profitsTotal = array_sum($profits);

        // Margem de lucro em todos os perídos
        $profitMarginEverage = $profitsTotal / $grossRevenueTotal * 100;

        // Meses das vendas
        $saleDates = implode(',', $saleDates);

        // Faturamento bruto total com base nos meses
        $grossRevenues = implode(',', $grossRevenues);

        // Quantidade de vendas total com base nos meses
        $salesQuantity = implode(',', $salesQuantity);

        // Lucro total com base nos meses
        $profits = implode(',', $profits);

        // Margem de lucro com base nos meses
        $profitMargins = implode(',', $profitMargins);

        // Dados do gráfico de barra vertical (Quantidade vendas por funcionário)
        $salesData = User::with('sales')->get();

        foreach ($salesData as $saleData) {
            $usersNames[] = '"' . $saleData->name . '"';
            $numberSalesPerEmployee[] = $saleData->sales->count();
        }

        // Nomes dos funcionários
        $usersNames = implode(',', $usersNames);

        // Quantidade de vendas por funcionário
        $numberSalesPerEmployee = implode(',', $numberSalesPerEmployee);

        // Dados do gráfico de rosca (Produtos mais vendidos)
        $productsData = SaleProduct::select([
            DB::raw('products.name as productName'),
            DB::raw('SUM(sale_products.quantity) as topSellingProduct'),
            ])
            ->join('products','sale_products.id_product','=','products.id')
            ->groupBy('productName')
            ->orderBy('topSellingProduct','desc')
            ->take(7)
            ->get();

        foreach ($productsData as $productData) {
            $productsNames[] = '"' . $productData->productName . '"';
            $topSellingProducts[] = $productData->topSellingProduct;
        }

        // Nomes dos produtos
        $productsNames = implode(',', $productsNames);

        // Quantidade de vendas por produto
        $topSellingProducts = implode(',', $topSellingProducts);

        // Dados do gráfico de barra horizontal (Quantidade de vendas por método de pagamento)
        $paymentMethodsData = Sale::select([
            DB::raw('sales.payment_method as paymentMethodName'),
            DB::raw('COUNT(sales.id) as NumberSalesPerPaymentMethod'),
        ])
            ->groupBy('paymentMethodName')
            ->orderBy('NumberSalesPerPaymentMethod','desc')
            ->get();

        foreach ($paymentMethodsData as $paymentMethodData) {
            $paymentMethodsNames[] = "'" . $paymentMethodData->paymentMethodName . "'";
            $NumberSalesPerPaymentMethods[] = $paymentMethodData->NumberSalesPerPaymentMethod;
        }

        // Nomes dos métodos de pagamentos
        $paymentMethodsNames = implode(',', $paymentMethodsNames);

        // Quantidade vendas por método de pagamento
        $NumberSalesPerPaymentMethods = implode(',', $NumberSalesPerPaymentMethods);

        return view('components.dashboard', compact('products', 'lastSales', 'productsWithLessThan10InStock', 'saleDates', 'grossRevenueTotal', 'grossRevenues', 'salesQuantity', 'salesQuantityTotal', 'profits', 'profitsTotal', 'profitMargins', 'profitMarginEverage', 'usersNames', 'numberSalesPerEmployee', 'productsNames', 'topSellingProducts', 'paymentMethodsNames', 'NumberSalesPerPaymentMethods'));
    }
}
