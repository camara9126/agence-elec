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
                    <div class="col-6">
                        <span><i class="fas fa-file-invoice" style="color: var(--primary); margin-right: 0.5rem;"></i>Affichage de devis </span>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-danger">Retour</a>
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


                    <!-- INFOS ENTREPRISE -->
                    <div class="mb-4">
                        <h4>{{ $devis->entreprise->nom ?? 'Entreprise' }}</h4>
                        <p>Date : {{ $devis->date_devis }}</p>
                        <p>Référence : {{ $devis->reference }}</p>

                        <p>
                            Statut :
                            @if($devis->statut == 'en_attente')
                                <span class="badge bg-warning">En attente</span>
                            @elseif($devis->statut == 'valide')
                                <span class="badge bg-success">Validé</span>
                            @else
                                <span class="badge bg-danger">Refusé</span>
                            @endif
                        </p>
                    </div>

                    <!-- CLIENT -->
                    <div class="mb-4">
                        @if($devis->client !== null)
                            <h5>Client</h5>
                            <p>Nom : {{ $devis->client->nom }}</p>
                            <p>Téléphone : {{ $devis->client->telephone ?? '-' }}</p>
                        @endif
                    </div>

                    <div class="text-center">
                      <p><b>Objet:</b> {{ $devis->objet }}</p>
                    </div>
                    <!-- TABLE PRODUITS -->
                    <table class="">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($devis->details as $detail)
                                <tr>
                                    <td>{{ $detail->designation ?? '-' }}</td>
                                    <td>{{ $detail->quantite }}</td>
                                    <td>{{ number_format($detail->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                    <td>{{ number_format($detail->total, 0, ',', ' ') }} FCFA</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- TOTAL -->
                    <div class="text-end mt-3">
                        <h4>Total : {{ number_format($devis->total, 0, ',', ' ') }} FCFA</h4>
                    </div>

                    <!-- ACTIONS -->
                    <div class="mt-4 d-flex gap-2">

                        @if($devis->statut == 'en_attente')
                            <!--<a href="{{ route('devis.valider', $devis->id) }}" class="btn btn-success">
                                    Valider le devis
                            </a>-->  

                            <form action="{{route('devis.destroy', $devis->id)}}" type="button" method="post" onsubmit="return confirm('Supprimer ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Supprimer">
                                    <i class="fa fa-trash"></i>Supprimer le devis
                                </button>
                            </form>
                        @endif

                        @if($devis->statut == 'valide')
                            <a href="{{ route('devis.facture', $devis->id) }}" class="btn btn-warning">
                                Generer la facture
                            </a>
                        @endif

                        @if(!$devis->converti_en_vente)
                          <a href="{{ route('devis.convertir', $devis->id) }}" class="btn btn-info">
                                Convertir en Bon de Commande
                          </a>
                        @endif
                        
            </div>
        </div>
        </div>
    </div>

    <script>
        let index = 1;

        // Ajouter ligne
        document.getElementById('addRow').addEventListener('click', function () {

            let row = `
            <tr>
                <td>
                    <select name="services[${index}][service_id]" class="form-control produit-select">
                        <option value="">Choisir</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" data-prix="{{ $service->prix }}">
                                {{ $service->nom }}
                            </option>
                        @endforeach
                    </select>
                </td>

                <td>
                    <input type="number" name="services[${index}][prix]" class="form-control prix" readonly>
                </td>

                <td>
                    <input type="number" name="services[${index}][quantite]" class="form-control quantite" value="1">
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
            index++;
        });

        // Supprimer ligne
        document.addEventListener('click', function(e){
            if(e.target.classList.contains('remove')){
                e.target.closest('tr').remove();
                calculTotal();
            }
        });

        // Auto remplir prix
        document.addEventListener('change', function(e){
            if(e.target.classList.contains('produit-select')){
                let prix = e.target.selectedOptions[0].dataset.prix;
                let row = e.target.closest('tr');
                row.querySelector('.prix').value = prix;
                calculLigne(row);
            }
        });

        // Calcul ligne
        document.addEventListener('input', function(e){
            if(e.target.classList.contains('quantite')){
                let row = e.target.closest('tr');
                calculLigne(row);
            }
        });

        function calculLigne(row){
            let prix = row.querySelector('.prix').value || 0;
            let quantite = row.querySelector('.quantite').value || 0;

            let total = prix * quantite;
            row.querySelector('.total-ligne').value = total;

            calculTotal();
        }

        // Calcul global
        function calculTotal(){
            let total = 0;

            document.querySelectorAll('.total-ligne').forEach(function(input){
                total += parseFloat(input.value) || 0;
            });

            document.getElementById('total-global').innerText = total.toLocaleString();
        }
    </script>

    </x-app-layout>

</body>
</html>