@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Novo Pedido</h1>
    <form action="{{ route('pedidos.store') }}" method="POST" id="form-pedido">
        @csrf

        <div class="row">
            <div class="col-md-3">
                <label>Representada</label>
                <select name="representada_id" class="form-control" required>
                    @foreach($representadas as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Cliente</label>
                <select name="cliente_id" class="form-control" required>
                    @foreach($clientes as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Representante</label>
                <select name="representante_id" class="form-control" required>
                    @foreach($representantes as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Transportadora</label>
                <select name="transportadora_id" class="form-control" required>
                    @foreach($transportadoras as $item)
                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr>

        <h4>Itens</h4>
        <table class="table" id="tabela-itens">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Qtd</th>
                    <th>Unitário</th>
                    <th>Desconto</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <button type="button" class="btn btn-secondary" onclick="addItem()">+ Adicionar Item</button>

        <div class="text-end mt-4">
            <strong>Total Geral: R$ <span id="total-geral">0.00</span></strong>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Salvar Pedido</button>
    </form>

    <div class="mt-4">
        <h5>Compartilhar via WhatsApp</h5>
        <input type="text" id="numero-wpp" class="form-control w-50 d-inline" placeholder="Digite o número com DDD">
        <button onclick="enviarWhatsapp()" class="btn btn-success">Enviar</button>
    </div>
</div>

<script>
    function addItem() {
        const tbody = document.querySelector('#tabela-itens tbody');
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td><input type="text" name="itens[][item]" class="form-control item-autocomplete" required></td>
            <td><input type="text" name="itens[][codigo]" class="form-control codigo-autocomplete"></td>
            <td><input type="text" name="itens[][descricao]" class="form-control descricao-autocomplete"></td>
            <td><input type="number" name="itens[][quantidade]" class="form-control quantidade" min="1" value="1" required></td>
            <td><input type="number" name="itens[][valor_unitario]" class="form-control valor-unitario" step="0.01" required></td>
            <td><input type="number" name="itens[][valor_com_desconto]" class="form-control desconto" step="0.01"></td>
            <td><input type="text" class="form-control total" readonly></td>
            <td><button type="button" class="btn btn-danger" onclick="this.closest('tr').remove(); calcularTotalGeral();">X</button></td>
        `;

        tbody.appendChild(tr);
        addListeners(tr);
        ativarAutocomplete();
    }

    function addListeners(tr) {
        const inputs = tr.querySelectorAll('.quantidade, .valor-unitario');
        inputs.forEach(input => input.addEventListener('input', () => calcularItem(tr)));
    }

    function calcularItem(tr) {
        const qtd = parseFloat(tr.querySelector('.quantidade').value) || 0;
        const unitario = parseFloat(tr.querySelector('.valor-unitario').value) || 0;
        const total = qtd * unitario;
        tr.querySelector('.total').value = total.toFixed(2);
        calcularTotalGeral();
    }

    function calcularTotalGeral() {
        let total = 0;
        document.querySelectorAll('.total').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total-geral').innerText = total.toFixed(2);
    }

    function enviarWhatsapp() {
        const numero = document.getElementById('numero-wpp').value.replace(/\D/g, '');
        const msg = encodeURIComponent("Pedido gerado com sucesso! Em breve enviaremos o PDF.");
        if (numero) {
            window.open(`https://wa.me/${numero}?text=${msg}`, '_blank');
        } else {
            alert("Digite um número válido!");
        }
    }

    function ativarAutocomplete() {
        const campos = ['item-autocomplete', 'codigo-autocomplete', 'descricao-autocomplete'];
        campos.forEach(classe => {
            document.querySelectorAll(`.${classe}`).forEach(input => {
                input.addEventListener('input', function () {
                    let chave = classe;
                    let lista = JSON.parse(localStorage.getItem(chave)) || [];

                    if (!lista.includes(this.value) && this.value.length > 2) {
                        lista.push(this.value);
                        localStorage.setItem(chave, JSON.stringify(lista));
                    }
                });
            });
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        ativarAutocomplete();
    });
</script>
@endsection
