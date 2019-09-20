import 'bootstrap/dist/css/bootstrap.min.css'
import "jquery";
import "react-popper";
import 'bootstrap/dist/js/bootstrap.min.js'
import React, { Component } from 'react';

import DataTable from './../../components/template/DataTable'

class MonthDataTable extends Component {
    renderTableHead() {
        if(this.props.tables[0] !== undefined){
            let tableKeys = Object.keys(this.props.tables[0]);
            return (
                <tr key={tableKeys.id}>
                    {this.tableHeadKeys(tableKeys)}
                </tr>
            )
        }
    }

    tableHeadKeys(keys){
        return keys.map(keys => {
            return (
                <th key={keys}>{keys}</th>
            )
        })
    }

    renderTableBody() {
        if(this.props.tables[0] !== undefined){
            
            return this.props.tables.map((tables, index) => {
                const { id } = tables //destructuring
                return (
                   <tr key={id}>
                       {this.tableBodyItens(id, tables)}
                   </tr>
                )
            })
            
        }
    }

    tableBodyItens(id,body){
        var i=0;
        return Object.keys(body).map(itens => {
            var itemId = i;
            i++
            return (
                <td key={`${id}_${itemId}`}>{body[itens]}</td>
            )
        })
    }

    render() {
        // console.log(keys(this.props.months[0]))
        console.log(this.props)
        return(
            <section>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="income-month-tab" data-toggle="tab" href="#income-month" role="tab" aria-controls="income-month" aria-selected="true">Income</a>
                        <a class="nav-item nav-link" id="payment-month-tab" data-toggle="tab" href="#payment-month" role="tab" aria-controls="payment-month" aria-selected="false">Payment</a>
                        <a class="nav-item nav-link" id="bill-mont-tab" data-toggle="tab" href="#bill-mont" role="tab" aria-controls="bill-mont" aria-selected="false">Bills</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="income-month" role="tabpanel" aria-labelledby="income-month-tab">
                        
                    </div>
                    <div class="tab-pane fade" id="payment-month" role="tabpanel" aria-labelledby="payment-month-tab">b</div>
                    <div class="tab-pane fade" id="bill-mont" role="tabpanel" aria-labelledby="bill-mont-tab">c</div>
                </div>
            </section>
        )
    }
}

export default MonthDataTable;