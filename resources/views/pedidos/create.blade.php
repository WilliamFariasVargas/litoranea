@extends('layouts.pages')

@section('content')
<div class="container">
    <h1>Novo Pedido</h1>
    <form action="{{ route('pedidos.store') }}" method="POST" id="form-pedido">
        @csrf

        <div class="row">
            <div class="col-md-3">
                <label>Representada</label>
                <select name="representada_id" class="form-control select2" required>
                    <option value="">Selecione</option>
                    @foreach($representadas as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->razao_social ?? $item->nome }}
                            @if($item->razao_social && $item->nome)
                                ({{ $item->nome }})
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Cliente</label>
                <select name="cliente_id" class="form-control select2" required>
                    <option value="">Selecione</option>
                    @foreach($clientes as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->razao_social ?? $item->nome }}
                            @if($item->razao_social && $item->nome)
                                ({{ $item->nome }})
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Representante</label>
                <select name="fornecedor_id" class="form-control select2" required>
                    <option value="">Selecione</option>
                    @foreach($fornecedores as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->razao_social ?? $item->nome }}
                            @if($item->razao_social && $item->nome)
                                ({{ $item->nome }})
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Transportadora</label>
                <select name="transportadora_id" class="form-control select2" required>
                    <option value="">Selecione</option>
                    @foreach($transportadoras as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->razao_social ?? $item->nome }}
                            @if($item->razao_social && $item->nome)
                                ({{ $item->nome }})
                            @endif
                        </option>
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

<!-- Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let itemIndex = 0;

    function addItem() {
        const tbody = document.querySelector('#tabela-itens tbody');
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td><input type="text" name="itens[${itemIndex}][item]" class="form-control item-autocomplete" required></td>
            <td><input type="text" name="itens[${itemIndex}][codigo]" class="form-control codigo-autocomplete"></td>
            <td><input type="text" name="itens[${itemIndex}][descricao]" class="form-control descricao-autocomplete"></td>
            <td><input type="number" name="itens[${itemIndex}][quantidade]" class="form-control quantidade" min="1" value="1" required></td>
            <td><input type="number" name="itens[${itemIndex}][valor_unitario]" class="form-control valor-unitario" step="0.01" required></td>
            <td><input type="number" name="itens[${itemIndex}][valor_com_desconto]" class="form-control desconto" step="0.01"></td>
            <td><input type="text" class="form-control total" readonly></td>
            <td><button type="button" class="btn btn-danger" onclick="this.closest('tr').remove(); calcularTotalGeral();">X</button></td>
        `;

        tbody.appendChild(tr);
        addListeners(tr);
        ativarAutocomplete();
        itemIndex++;
    }

    function addListeners(tr) {
        const inputs = tr.querySelectorAll('.quantidade, .valor-unitario, .desconto');
        inputs.forEach(input => input.addEventListener('input', () => calcularItem(tr)));
    }

    function calcularItem(tr) {
        const qtd = parseFloat(tr.querySelector('.quantidade').value) || 0;
        const unitario = parseFloat(tr.querySelector('.valor-unitario').value) || 0;
        const desconto = parseFloat(tr.querySelector('.desconto').value) || 0;

        const total = (qtd * unitario) - desconto;
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
    if (!numero) return alert("Digite um número válido!");

    let texto = `📦 *Pedido Gerado com Sucesso!*\n\n`;

    // Dados dos selects
    const getText = (selector) => {
        const el = document.querySelector(selector);
        return el ? el.options[el.selectedIndex]?.text?.trim() ?? '-' : '-';
    };

    texto += `👤 *Cliente:* ${getText('[name="cliente_id"]')}\n`;
    texto += `🏢 *Representada:* ${getText('[name="representada_id"]')}\n`;
    texto += `📦 *Fornecedor:* ${getText('[name="fornecedor_id"]')}\n`;
    texto += `🚚 *Transportadora:* ${getText('[name="transportadora_id"]')}\n\n`;

    // Itens da tabela
    texto += `📋 *Itens do Pedido:*\n`;

    const linhas = document.querySelectorAll('#tabela-itens tbody tr');
    if (linhas.length === 0) {
        texto += '_Nenhum item adicionado._\n';
    }

    linhas.forEach((tr, i) => {
        const item = tr.querySelector('[name*="[item]"]')?.value || '-';
        const cod = tr.querySelector('[name*="[codigo]"]')?.value || '-';
        const desc = tr.querySelector('[name*="[descricao]"]')?.value || '-';
        const qtd = tr.querySelector('[name*="[quantidade]"]')?.value || '-';
        const unit = tr.querySelector('[name*="[valor_unitario]"]')?.value || '0';
        const descR = tr.querySelector('[name*="[valor_com_desconto]"]')?.value || '0';
        const total = tr.querySelector('.total')?.value || '0';

        texto += `\n${i+1}️⃣ ${desc} (Cod: ${cod})\n🧾 ${qtd} un x R$ ${unit} - Desc: R$ ${descR} - Total: R$ ${total}`;
    });

    // Total Geral
    const totalGeral = document.getElementById('total-geral').innerText;
    texto += `\n\n💰 *Total Geral:* R$ ${totalGeral}`;

    const url = `https://wa.me/${numero}?text=${encodeURIComponent(texto)}`;
    window.open(url, '_blank');
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

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Selecione ou digite para buscar',
            allowClear: true,
            language: {
                noResults: function () {
                    return "Nenhum resultado encontrado";
                }
            }
        });

        ativarAutocomplete();
    });
</script>
@endsection
