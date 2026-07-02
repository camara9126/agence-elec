<x-app-layout>
    
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #f0f4f8;
      font-family: 'Inter', sans-serif;
      color: #1e2a3e;
      padding: 24px 20px;
    }

    /* Layout principal */
    .dashboard-container {
      max-width: 1440px;
      margin: 0 auto;
    }

    /* HEADER */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 32px;
    }
    .logo-area h1 {
      font-family: 'Playfair Display', serif;
      font-size: 1.9rem;
      font-weight: 600;
      background: linear-gradient(135deg, #0B2B40, #1C4E6F);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      letter-spacing: -0.3px;
    }
    .logo-area p {
      font-size: 0.85rem;
      color: #2c6e9e;
      font-weight: 500;
      border-left: 3px solid #e8b23c;
      padding-left: 12px;
      margin-top: 6px;
    }
    .admin-badge {
      background: white;
      border-radius: 40px;
      padding: 8px 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.04);
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .admin-badge i {
      font-size: 1.4rem;
      color: #e8b23c;
    }
    .admin-badge span {
      font-weight: 600;
    }

    /* Stats cards */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 32px;
    }
    .stat-card {
      background: white;
      border-radius: 28px;
      padding: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.02), 0 2px 6px rgba(0,0,0,0.05);
      transition: all 0.2s;
      border: 1px solid #e9edf2;
    }
    .stat-card .stat-title {
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: 600;
      color: #5b6e8c;
    }
    .stat-number {
      font-size: 2.2rem;
      font-weight: 800;
      margin: 12px 0 4px;
      color: #0f2b3b;
    }
    .trend {
      font-size: 0.8rem;
      display: flex;
      align-items: center;
      gap: 6px;
      color: #2c7a4d;
    }
    .trend.down { color: #b91c1c; }

    /* onglets */
    .tabs {
      display: flex;
      gap: 6px;
      border-bottom: 2px solid #e2e8f0;
      margin-bottom: 28px;
      flex-wrap: wrap;
    }
    .tab-btn {
      background: transparent;
      border: none;
      padding: 12px 20px;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      color: #4b5e77;
      transition: all 0.2s;
      border-radius: 30px;
    }
    .tab-btn i { margin-right: 8px; }
    .tab-btn.active {
      background: #1C4E6F;
      color: white;
      box-shadow: 0 6px 12px rgba(28,78,111,0.2);
    }
    .tab-pane {
      display: none;
      animation: fade 0.25s ease;
    }
    .tab-pane.active-pane {
      display: block;
    }
    @keyframes fade {
      from { opacity: 0; transform: translateY(6px);}
      to { opacity: 1; transform: translateY(0);}
    }

    /* tables & cards */
    .content-table {
      background: white;
      border-radius: 24px;
      overflow-x: auto;
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
      border: 1px solid #eef2f6;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 0.85rem;
    }
    th {
      text-align: left;
      padding: 16px 16px;
      background: #fafcff;
      font-weight: 600;
      color: #1f3b4c;
      border-bottom: 1px solid #e2edf2;
    }
    td {
      padding: 14px 16px;
      border-bottom: 1px solid #f0f3f8;
      vertical-align: middle;
    }
    .status-badge {
      background: #e9f5eb;
      color: #1f7840;
      padding: 4px 10px;
      border-radius: 40px;
      font-size: 0.7rem;
      font-weight: 600;
      display: inline-block;
    }
    .status-badge.pending { background: #fff0db; color: #b45f06; }
    .status-badge.draft { background: #eef2ff; color: #2c3e66; }
    .action-icons i {
      margin: 0 6px;
      cursor: pointer;
      color: #7f8fa4;
      transition: 0.1s;
    }
    .action-icons i:hover { color: #1C4E6F; }

    /* formulaire publication */
    .form-card {
      background: white;
      border-radius: 28px;
      padding: 24px;
      margin-top: 20px;
      border: 1px solid #eef2f6;
    }
    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }
    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border-radius: 18px;
      border: 1px solid #cfddee;
      font-family: 'Inter', sans-serif;
      font-size: 0.9rem;
    }
    label {
      font-weight: 600;
      display: block;
      margin-bottom: 6px;
      font-size: 0.8rem;
    }
    .btn-primary {
      background: #0f2b3b;
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 34px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.2s;
      margin-top: 10px;
    }
    .btn-primary:hover { background: #1f5377; transform: translateY(-1px); }

    /* calendrier simplifié */
    .calendar-mini {
      background: white;
      border-radius: 24px;
      padding: 20px;
    }
    .event-item {
      display: flex;
      justify-content: space-between;
      border-bottom: 1px solid #eef;
      padding: 12px 0;
    }

    /* footer */
    .footer-actions {
      margin-top: 40px;
      background: #f8fafd;
      border-radius: 20px;
      padding: 20px;
      text-align: center;
      font-size: 0.8rem;
    }

    @media (max-width: 680px) {
      .header { flex-direction: column; align-items: start; }
    }
  </style>
</head>
<body>
    <div class="dashboard-container mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8">
                                <span><i class="fas fa-file-invoice" style="color: var(--primary); margin-right: 0.5rem;"></i>Modification de devis </span>
                            </div>
                            <div class="col-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">Annuler</a>
                            </div>
                        </div>  
                    </div>
                    
                    @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @elseif(Session::has('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('danger') }}
                        </div>
                    @endif

                    <div class="card-body">
                        @if ($errors->any())
                            <div style="color: red; margin-bottom: 10px;">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form method="post" action="{{ route('devis.update', $devis) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                              <div class="col-7">
                                    <label>Objet</label>
                                <input type="text" name="objet" value="{{ $devis->objet }}" class="form-control">
                              </div>
                              <div class="col-5">
                                <!-- CLIENT -->
                                <div class="mb-3">
                                    <label>Client</label>
                                    <select name="client_id" class="form-control" required>
                                        @if($devis->client !== null)
                                            <option value="{{$devis->client->id}}">{{$devis->client->nom}}</option>
                                        @endif
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              </div>
                            </div>

                            <!-- PRODUITS -->
                            <table class="table table-bordered" id="table-produits">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($devis->details as $index => $detail)
                                    <tr id="row-{{ $index }}">
                                        <td>
                                            <input type="text" name="services[{{ $index }}][designation]" value="{{ $detail->designation }}" class="form-control" placeholder="designation">
                                               
                                        </td>
                                        <td>
                                            <input type="number" name="services[{{ $index }}][prix]" value="{{ $detail->prix_unitaire }}" class="form-control prix" required step="any">
                                        </td>
                                        <td>
                                            <input type="number" name="services[{{ $index }}][quantite]" value="{{ $detail->quantite }}" class="form-control quantite" required min="1">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control total-ligne" value="{{ $detail->total }}" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove">X</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <button type="button" id="addRow" class="btn btn-primary">+ Ajouter produit</button>

                            <!-- TOTAL -->
                            <div class="mt-3">
                                <h4>Total : <span id="total-global">0</span> FCFA</h4>
                            </div>

                            <button type="submit" class="btn btn-success mt-3">Modifier</button>
                        </form>
                    </div>
                </div>
    </div>
    



<script>
    let rowIndex = {{ $devis->details->count() }}; // Commencer après le dernier index existant

    // Ajouter ligne (CORRIGÉ)
    document.getElementById('addRow').addEventListener('click', function () {
        // Générer les options des services
        let options = '';
        @foreach($services as $service)
            options += `<option value="{{ $service->id }}" data-prix="{{ $service->prix }}">{{ $service->nom }}</option>`;
        @endforeach
        
        let row = `
            <tr id="row-new-${rowIndex}">
                <td>
                   <input type="text" name="services[${rowIndex}][designation]" value="{{ $detail->designation }}" class="form-control" placeholder="designation">
                    
                </td>
                <td>
                    <input type="number" name="services[${rowIndex}][prix]" class="form-control prix" required step="any">
                </td>
                <td>
                    <input type="number" name="services[${rowIndex}][quantite]" class="form-control quantite" value="1" required min="1">
                </td>
                <td>
                    <input type="number" class="form-control total-ligne" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove">X</button>
                </td>
            </tr>
        `;
        
        document.querySelector('#table-produits tbody').insertAdjacentHTML('beforeend', row);
        rowIndex++;
    });

    // Supprimer ligne
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('remove')){
            e.target.closest('tr').remove();
            calculTotal();
        }
    });

    // Auto remplir prix et calculer
    document.addEventListener('change', function(e){
        if(e.target.classList.contains('produit-select')){
            let selectedOption = e.target.selectedOptions[0];
            let prix = selectedOption.dataset.prix;
            let row = e.target.closest('tr');
            let prixInput = row.querySelector('.prix');
            
            if(prixInput) {
                prixInput.value = prix;
            }
            calculLigne(row);
        }
    });

    // Calcul ligne (déclenché par quantité ou prix)
    document.addEventListener('input', function(e){
        if(e.target.classList.contains('quantite') || e.target.classList.contains('prix')){
            let row = e.target.closest('tr');
            calculLigne(row);
        }
    });

    function calculLigne(row){
        let prix = parseFloat(row.querySelector('.prix').value) || 0;
        let quantite = parseFloat(row.querySelector('.quantite').value) || 0;

        let total = prix * quantite;
        let totalInput = row.querySelector('.total-ligne');
        
        if(totalInput) {
            totalInput.value = total.toFixed(2);
        }
        
        calculTotal();
    }

    // Calcul global
    function calculTotal(){
        let total = 0;

        document.querySelectorAll('.total-ligne').forEach(function(input){
            let val = parseFloat(input.value);
            if(!isNaN(val)) {
                total += val;
            }
        });

        let totalSpan = document.getElementById('total-global');
        if(totalSpan) {
            totalSpan.innerText = total.toLocaleString('fr-FR', {minimumFractionDigits: 0, maximumFractionDigits: 0});
        }
    }

    // Initialiser le total au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        calculTotal();
    });
</script>

 </x-app-layout>

</body>
</html>