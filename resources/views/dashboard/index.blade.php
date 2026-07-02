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

  <style>
    /* Styles spécifiques à la caisse */
    .pos-dashboard {
        display: flex;
        background: #f0f2f5;
        min-height: 100vh;
    }

    .pos-main {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
    }

    .pos-content {
        max-width: 1600px;
        margin: 0 auto;
    }

    /* Layout deux colonnes */
    .pos-two-columns {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .pos-left {
        flex: 2;
        min-width: 300px;
    }

    .pos-right {
        flex: 1;
        min-width: 280px;
    }

    /* Cartes */
    .pos-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .pos-card-header {
        background: #2c3e50;
        color: white;
        padding: 15px 20px;
        font-weight: 600;
        font-size: 18px;
    }

    .pos-card-body {
        padding: 20px;
    }

    /* Catégories produits */
    .category-header {
        background: #e7f3ff;
        padding: 10px 15px;
        border-radius: 8px;
        margin: 15px 0 10px 0;
        font-weight: 600;
        color: #0066cc;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .product-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .product-card {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 10px 15px;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        min-width: 120px;
    }

    .product-card:hover {
        background: #e9ecef;
        transform: translateY(-2px);
        border-color: #0066cc;
    }

    .product-name {
        font-weight: 600;
        font-size: 14px;
    }

    .product-price {
        font-size: 12px;
        color: #e67e22;
        font-weight: 600;
    }

    .product-ref {
        font-size: 10px;
        color: #6c757d;
    }

    /* Table des services */
    .services-table {
        width: 100%;
        border-collapse: collapse;
    }

    .services-table th,
    .services-table td {
        padding: 12px 8px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .services-table th {
        background: #f8f9fa;
        font-weight: 600;
        font-size: 13px;
        color: #495057;
    }

    .form-control-sm {
        padding: 6px 10px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        font-size: 14px;
        width: 100%;
    }

    select.form-control-sm {
        cursor: pointer;
    }

    .btn-icon {
        background: none;
        border: none;
        color: #dc3545;
        cursor: pointer;
        font-size: 18px;
        padding: 5px 8px;
        border-radius: 6px;
    }

    .btn-icon:hover {
        background: #fee2e2;
    }

    /* Résumé */
    .summary-line {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .summary-total {
        font-size: 22px;
        font-weight: 700;
        color: #2c3e50;
        padding: 15px 0;
        border-top: 2px solid #dee2e6;
        margin-top: 10px;
    }

    .tax-box {
        background: #f8f9fa;
        padding: 12px;
        border-radius: 8px;
        margin: 15px 0;
    }

    /* Pavé client */
    .client-pad {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 15px;
        margin-top: 20px;
    }

    .numpad {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin: 15px 0;
    }

    .num-btn {
        background: white;
        border: 1px solid #dee2e6;
        padding: 12px;
        text-align: center;
        font-weight: 600;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .num-btn:hover {
        background: #e9ecef;
        border-color: #0066cc;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .btn-custom {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-primary-custom {
        background: #0066cc;
        color: white;
    }

    .btn-secondary-custom {
        background: #6c757d;
        color: white;
    }

    .text-muted-small {
        font-size: 11px;
        color: #6c757d;
        text-align: center;
        margin-top: 12px;
    }

    .badge-combo {
        background: #e7f3ff;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        display: inline-block;
        margin: 3px;
    }

    @media (max-width: 900px) {
        .pos-two-columns {
            flex-direction: column;
        }
    }
</style>
</head>
<body>
    <div class="dashboard-container mt-4">

        <!-- KPI rapides -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-title">
                    📄 services publiés 
                </div>
                <div class="stat-number">{{ $services->count() }}</div>
                <div class="trend">
                    <!--<i class="fas fa-arrow-up"></i> +2 vs mois préc.-->
                </div>
            </div>
            <!--<div class="stat-card">
                <div class="stat-title">
                    👁️ Vues totales contenu
                </div>
                <div class="stat-number">2 450</div>
                <div class="trend">
                    <i class="fas fa-chart-simple"></i> +18%
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-title">
                    🤝 Clients actifs
                </div>
                <div class="stat-number">187</div>
                <div class="trend">
                    🎯 objectif 200
                </div>
            </div>-->
            <div class="stat-card">
                <div class="stat-title">
                    📢 Méssages recus
                </div>
                <div class="stat-number">0</div>
                <div class="trend">
                    <!--<i class="fas fa-share-alt"></i> +30%-->
                </div>
            </div>
        </div>

        <!-- Navigation par onglets -->
        <div class="tabs">
            <button class="tab-btn active" data-tab="tab1">
                <i class="fas fa-newspaper"></i> Contrats & éditorial
            </button>
            <button class="tab-btn" data-tab="tab10">
                <i class="fas fa-file-invoice"></i> Facture
            </button>
             <button class="tab-btn" data-tab="tab3">
                <i class="fas fa-users"></i> Clients
            </button>
            <button class="tab-btn" data-tab="tab4">
                <i class="fas fa-receipt"></i>Devis
            </button>
            <button class="tab-btn" data-tab="tab5">
                <i class="fas fa-chart-pie"></i> Indicateurs cabinet
            </button>
            <button class="tab-btn" data-tab="tab6">
                <i class="fas fa-box"></i> Services <pre class="badge bg-success"></pre>
            </button>
            <button class="tab-btn" data-tab="tab8">
                <i class="fas fa-bag-shopping"></i> Achat <pre class="badge bg-success"></pre>
            </button>
        </div>

         @if ($errors->any())
            <div class="alert alert-danger text-center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ Session::get('success') }}
            </div>
        @elseif(Session::has('danger'))
            <div class="alert alert-danger text-center" role="alert">
                {{ Session::get('danger') }}
            </div>
        @endif

        <!-- ================= PANEL 1 : GESTION DES CONTRATS ================= -->
        <div id="tab1" class="tab-pane active-pane">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4>
                                <i class="fas fa-receipt"></i> Liste des contrats
                            </h4>
                        </div>
                        <div class="col-4">
                            <button class="tab-btn btn btn-outline-success" data-tab="tab2">
                                Nouveau contrat ->
                            </button>
                        </div>
                    </div>
                </div>
            <div class="content-table">
                
                <table>
                    <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Titre</th> 
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="publications-table-body">
                        @forelse($contrats as $c)
                            <tr>
                                <td>{{ $c->reference }}</td>
                                <td>{{ $c->titre }}</td>  
                                <td>{{ $c->date }}</td>
                                <td>
                                    <a href="{{ route('contrat.show', $c->id) }}" class="btn btn-warning">
                                        &nbsp;Afiicher&nbsp;
                                    </a>
                                    
                                    <form action="{{ route('contrat.destroy', $c->id) }}" type="button" method="post" onsubmit="return confirm('Supprimer ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            &nbsp;Supprimer&nbsp;
                                        </button>
                                    </form>                                    
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center"> données vide</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================= PANEL 2 : FORMULAIRE DE GENERATION CONTRAT ================= -->
        <div id="tab2" class="tab-pane">
            <div class="form-card">
                <h3 style="margin-bottom: 20px;">
                    <i class="fas fa-feather-alt"></i> Nouveau contrat
                </h3>
                <form action="{{ route('contrat.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-6">
                                    <label>Titre *</label>
                                    <input type="text" name="titre" placeholder="Ex: Nouvelles obligations fiscales 2026">
                            </div>
                            <div class="col-6">
                                    <label>Editeur</label>
                                    <input type="text" name="editeur">
                            </div>
                        </div>
                    
                        <div class="row mt-3">
                            <div class="col-12">
                                    <label>Contenu *</label>
                                    <textarea rows="15" colspan="30" name="contenu" id="editor" class="form-control" placeholder="Rédiger le contrat..."></textarea>
                            </div>
                        </div>
                          
                    <div style="display: flex; gap: 16px; margin-top: 24px;">
                        <button class="btn-primary" type="submit">
                            <i class="fas fa-globe"></i> Publier
                        </button>
                    </div>
                </form> 
            </div>
        </div>

        <!-- ================= PANEL 3 : CLIENTS ================= -->
        <div id="tab3" class="tab-pane">
            <div class="form-card">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#clientModal">
                    Nouveau client →
                </button>

                <!-- Nouveau client -->
                <div class="modal fade" id="clientModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="post" action="{{route('client.store')}}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Nouveau client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nom du client</label>
                                        <input type="text" name="nom" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Téléphone</label>
                                        <input type="text" name="telephone" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Adresse</label>
                                        <textarea name="adresse" id=""></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit client -->
                <div class="modal fade" id="clientEditModal" tabindex="-1">
                    <div class="modal-dialog">

                        <form method="post" id="editClientForm" action="">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modification client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" name="id" id="client_id">

                                    <div class="mb-3">
                                        <label>Nom du client</label>
                                        <input type="text" name="nom" id="name" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Téléphone</label>
                                        <input type="text" name="telephone" id="phone" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Adresse</label>
                                        <textarea name="adresse" id="adress" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr>

            <div class="content-table mt-3">
                <div class="form-card">
                    <h3 style="margin-bottom: 20px;">
                        <i class="fas fa-users-alt"></i> Liste des  clients
                    </h3>
                    <table>
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th style="width:100px">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="publications-table-body">
                            @forelse($clients as $c)
                                <tr>
                                    <td>{{ $c->nom }}</td>
                                    <td>{{ $c->telephone ?? 'vide' }}</td>
                                    <td>{{ $c->email ?? 'vide' }}</td>
                                    <td>
                                        <a href="#" class="badge bg-warning" data-bs-toggle="modal" data-id="{{ $c->id }}" data-name="{{ $c->nom }}" data-phone="{{ $c->telephone }}" data-email="{{ $c->email }}" data-adress="{{$c->adresse }}" data-bs-target="#clientEditModal">
                                            <i class="fas fa-edit" title="Modifier" onclick=""></i>
                                        </a>
                                        
                                        <form action="{{ route('client.destroy', $c->id) }}" type="button" method="post" onsubmit="return confirm('Supprimer ce client ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge bg-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="3" class="text-center">
                                    données Vide
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  

        <!-- ================= PANEL 4 : DEVIS ================= -->
        <div id="tab4" class="tab-pane">
            <div class="calendar-mini">
                <div class="row mb-4">
                    <div class="col-8">
                        <h4>
                            <i class="fas fa-receipt"></i> Liste des devis
                        </h4>
                    </div>
                    <div class="col-4">
                        <button class="tab-btn btn btn-outline-success" data-tab="tab7">
                            Nouveau devis ->
                        </button>
                    </div>
                </div>
                
                
                <div id="editorialCalendarList">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Reference</th>
                                <th>Client</th>
                                <th>Total Devis</th>
                                <th>Date de devis</th>
                                <th>Date d'expiration</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($devis as $d)
                            <tr>
                                <td>{{$d->reference}}</td>
                                <td>{{$d->client->nom ?? 'Client Anonyme'}}</td>
                                <td>{{number_format($d->total, 0, ',',' ')}} XOF</td>
                                <td>{{$d->date_devis}}</td>
                                <td>{{$d->date_expiration}}</td>
                                <td>
                                    @if($d->statut == 'valide')
                                        <span class="badge bg-success">{{$d->statut}}</span>
                                    @elseif($d->statut == 'en_attente')
                                        <span class="badge bg-warning">{{$d->statut}}</span>
                                    @else
                                        <span class="badge bg-danger">{{$d->statut}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('devis.show', $d->id)}}" class="btn btn-info" title="afficher le devis">
                                        &nbsp;Afficher&nbsp;
                                    </a>
                                
                                    <a href="{{route('devis.edit', $d->id)}}" class="btn btn-warning" title="modifier le devis">
                                        &nbsp;Editer&nbsp;
                                    </a>    
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" align="center">Donnee vide !</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
               
            </div>
        </div>

        <!-- ================= PANEL 5 : INDICATEURS CABINET & PERFORMANCE ================= -->
        <div id="tab5" class="tab-pane">
            <div class="stats-grid" style="grid-template-columns: repeat(2,1fr);">
                <div class="stat-card">
                    <div class="stat-title">Contrat en cours</div>
                    <div class="stat-number">{{ $contrats->count() }}</div>
                </div>
            <div class="stat-card">
                <div class="stat-title">Deivs</div>
                <div class="stat-number">{{ $devis->count() }}</div>
                <div class="trend">objectif 45</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Factures</div>
                <div class="stat-number">{{ $factures->count() }}</div>
                <div class="trend"><i class="fas fa-check-circle"></i> +1%</div>
            </div>
            <div class="stat-card">
                <div class="stat-title">NPS (recommandation)</div>
                <div class="stat-number">+52</div>
                <div class="trend">🎯 > +60</div>
            </div>
        
            <div class="content-table" style="margin-top: 16px;">
                <table>
                    <thead>
                        <tr>
                            <th>Prochaine échéance légale</th>
                            <th>Date</th><th>Clients impactés</th>
                            <th>🔔 Alerte</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Déclaration TVA mensuelle</td>
                            <td>20/04/2026</td>
                            <td>87 clients</td>
                            <td>
                                <span class="status-badge" style="background:#fbebc8;">Rappel envoyé</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Dépôt comptes annuels ASBL</td>
                            <td>30/04/2026</td>
                            <td>32 associations</td>
                            <td>
                                <span class="status-badge pending">À programmer</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        </div>
  
        </div>

        <!-- ================= PANEL 6 : SERVICES ================= -->
        <div id="tab6" class="tab-pane">
            <div class="content-table">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"  data-bs-target="#serviceModal">
                    Nouveau service →
                </button>
                <table>
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Reference</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th style="width:100px">Actions</th>
                    </tr>
                    </thead>
                    <tbody id="publications-table-body">
                        @forelse($services as $s)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/'.$s->image) }}" width="100" alt="">
                                </td>
                                <td>{{ $s->reference }}</td>
                                <td>{{ $s->nom }}</td>
                                <td>{{ $s->prix }}</td>
                                <td>
                                    <a href="" class="badge bg-warning" data-bs-toggle="modal" data-id="{{ $s->id }}" data-name="{{ $s->nom }}"  data-price="{{ $s->prix }}" data-description="{{ $s->description }}" data-image="{{ asset('storage/'.$s->image) }}" data-bs-target="#serviceEditModal">
                                        <i class="fas fa-eye" title="Voir"></i>
                                    </a>
                                    <form action="" type="button" method="post" onsubmit="return confirm('Supprimer le message ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" badge bg-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center"> données vide</td>
                        @endforelse
                    </tbody>
                </table>

                <!-- Nouveau service -->
                <div class="modal fade" id="serviceModal" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="post" action="{{route('service.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Nouveau service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label>Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Nom du service</label>
                                        <input type="text" name="nom" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Prix</label>
                                        <input type="text" name="prix" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description"  class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit service -->
                <div class="modal fade" id="serviceEditModal" tabindex="-1">
                    <div class="modal-dialog">

                        <form method="post" id="editServiceForm" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modification service</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <input type="hidden" name="id" id="service_id">

                                    <div class="mb-3">
                                        <label>Image</label>
                                        <img src="image" id="image" width="100" alt="">
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Nom service</label>
                                        <input type="text" name="nom" id="name" class="form-control" required>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label>Prix</label>
                                        <input type="text" name="prix" id="price" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    
            </div>
        </div>

        <!-- ================= PANEL 7 : FORMULAIRE DEVIS ================= -->
        <div id="tab7" class="tab-pane">
            <div class="form-card">
                <form action="{{ route('devis.store') }}" method="POST">
                    @csrf
                    <!-- CLIENT -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>Objet</label>
                                <input type="text" name="objet" class="form-control">                        
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Client</label>
                                <select name="client_id" class="form-control">
                                    <option value="">-- Choisir un client --</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2 mt-3">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#clientDevisModal" style="padding: 6px 12px;">
                                    + Nouveau client
                                </button>
                            </div>   
                        </div>


                    <!-- DESIGNATION -->
                    <table class="" id="table-produits">
                        <thead>
                            <tr>
                                <th>Designation</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="services[0][designation]"  class="form-control" placeholder="designation"> 
                                </td>

                                <td>
                                    <input type="number" name="services[0][prix]" class="form-control prix" >
                                </td>

                                <td>
                                    <input type="number" name="services[0][quantite]" class="form-control quantite" value="1">
                                </td>

                                <td>
                                    <input type="number" class="form-control total-ligne" readonly>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger remove">X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" id="addRow" class="btn btn-primary">+ Ajouter produit</button>

                    <!-- TOTAL -->
                    <div class="mt-3">
                        <h4>Total : <span id="total-global">0</span> FCFA</h4>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                </form>   
                
               
            </div>

            <!-- Nouveau client -->
            <div class="modal fade" id="clientDevisModal" tabindex="-1">
                <div class="modal-dialog">
                    <form method="post" action="{{route('client.store')}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Nouveau client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nom du client</label>
                                    <input type="text" name="nom" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Téléphone</label>
                                    <input type="text" name="telephone" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Adresse</label>
                                    <textarea name="adresse" id=""></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- ================= PANEL 8 : ACHAT ================= -->
        <div id="tab8" class="tab-pane">
            <div class="form-card">
                <div class="row mb-4">
                    <div class="col-8">
                        <h4>
                            <i class="fas fa-receipt"></i> Liste des achats
                        </h4>
                    </div>
                    <div class="col-4">
                        <button class="tab-btn btn btn-outline-success" data-tab="tab9">
                            Nouveau achat ->
                        </button>
                    </div>
                </div>
                <table class="table-responsive">
                    <thead>
                        <tr>
                            <th>Référence</th>
                            <th>Fournisseur</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($achats as $a)
                            <tr>
                                <td>{{ $a->reference }}</td>

                                <td>{{ $a->fournisseur->nom ?? '-' }}</td>

                                <td>{{ $a->created_at->format('d/m/y') }}</td>

                                <td>{{ number_format($a->total, 0, ',', ' ') }} FCFA</td>

                                <td>
                                    @if($a->statut == 'en_attente')
                                        <span class="badge bg-warning">En attente</span>
                                    @elseif($a->statut == 'envoye')
                                        <span class="badge bg-info">Envoyé</span>
                                    @elseif($a->statut == 'recu')
                                        <span class="badge bg-success">Reçu</span>
                                    @endif
                                </td>

                                <td class="d-flex gap-1">

                                    <!-- Voir -->
                                    <a href="{{ route('achat.show', $a->id) }}" 
                                    class="btn btn-sm btn-info">
                                        &nbsp;Afficher&nbsp;
                                    </a>

                                    <!-- Supprimer -->
                                    <form action="{{ route('achat.destroy', $a->id) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Supprimer ?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            Supprimer
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Aucun bon de commande trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

         <!-- ================= PANEL 9 : FORMULAIRE ACHAT ================= -->
        <div id="tab9" class="tab-pane">
            <div class="form-card">
                <form action="{{ route('achat.store') }}" method="POST">
                    @csrf

                    <!-- FOURNISSEUR -->
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label>Fournisseur</label>
                                <input type="text" name="fournisseur" class="form-control" placeholder="nouveau fournisseur">

                                <select name="fournisseur_id" class="form-control">
                                    <option value="">-- Choisir un fournisseur --</option>
                                    @foreach($fournisseurs as $fournisseur)
                                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        
                    </div>
                    
                    <!-- TABLE services -->
                    <table class="" id="table-achats">
                        <thead>
                            <tr>
                                <th>Designation</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="services[0][designation]" class="form-control designation">
                                </td>

                                <td>
                                    <input type="number" name="services[0][prix]" class="form-control prix">
                                </td>

                                <td>
                                    <input type="number" name="services[0][quantite]" class="form-control quantite" value="1">
                                </td>

                                <td>
                                    <input type="number" class="form-control total-ligne" readonly>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-danger remove">X</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" id="addRows" class="btn btn-primary">+ Ajouter une ligne</button>

                    <!-- TOTAL GLOBAL -->
                    <div class="mt-3 text-end">
                        <h4>Total : <span id="total-global">0</span> FCFA</h4>
                    </div>

                    <!-- NOTE -->
                    <div class="mt-3">
                        <label>Note</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">
                        Enregistrer
                    </button>
                </form>
            </div>
        </div>

        <!-- ================= PANEL 10 : FACTURE ================= -->
        <div id="tab10" class="tab-pane">
            <div class="form-card">
                <div class="row mb-4">
                    <div class="col-8">
                        <h4>
                            <i class="fas fa-file-invoice"></i> Factures
                        </h4>
                    </div>
                    <div class="col-4">
                        <button class="tab-btn btn btn-outline-success" data-tab="tab11">
                            Nouvelle facture ->
                        </button>
                    </div>
                </div>
                <table class="">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <!--<th>Client</th>-->
                            <!--<th>Montant TVA</th>-->
                            <th>Montant Total</th>
                            <!-- <th>Montant Payer</th> -->
                            <!-- <th>Montant Restant</th> -->
                            <th>Date</th>
                            <th>Statut</th>
                            <!--<th>Actions</th>-->
                            <th>Ticket de caisse</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($factures as $f)
                            <tr>
                                <td>{{$f->reference}}</td>
                                <!--<td>{{$f->client->nom ?? 'Client supprimee'}}</td>-->
                                <!--<td>{{number_format($f->total_tva, 0, ',',' ')}} XOF</td>-->
                                <td>{{number_format($f->total_ttc, 0, ',',' ')}} XOF</td>
                                <!-- <td>{{number_format($f->montant_paye, 0, ',', ' ')}} XOF</td> -->
                                <!-- <td>{{number_format($f->montant_restant, 0, ',',' ')}} XOF</td> -->
                                <td>{{$f->created_at->format('d/m/y')}}</td>
                                <td>
                                    @if($f->statut == 'payee')
                                        <span class="status-badge badge bg-success text-white">{{$f->statut}}</span>
                                    @elseif($f->statut == 'partielle')
                                        <span class="status-badge badge bg-info text-white">{{$f->statut}}</span>
                                    @else
                                        <span class="status-badge badge bg-danger text-white">{{$f->statut}}</span>
                                    @endif
                                </td>
                                <!--<td>
                                    @if($f->montant_restant == 0)
                                        <button type="button" class="btn btn-secondary">
                                                Payée
                                        </button>
                                    @else
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-id="{{$f->id}}" data-bs-target="#paiementModal">Payer
                                    </button>
                                    @endif
                                </td>-->
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{route('facture.show', $f->id)}}" class="btn btn-warning mr-2" title="Imprimer le ticket de caisse">
                                                Imprimer
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{route('facture.destroy', $f->id)}}" type="button" method="post" onsubmit="return confirm   ('Supprimer ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" align="center">Donnee vide !</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ================= PANEL 11 : FORMULAIRE FACTURE ================= -->
        <div id="tab11" class="tab-pane">
            <div class="form-card">
                <form action="{{ route('facture.store') }}" method="POST" id="venteForm">
                    @csrf

                    <div class="pos-two-columns">
                        <!-- COLONNE GAUCHE : Produits + Panier -->
                        <div class="pos-left">
                            <div class="pos-card">
                                <div class="pos-card-header">
                                    <i class="fas fa-box" style="margin-right: 8px;"></i> Caisserie · REGILEC
                                </div>
                                <div class="pos-card-body">
                                    
                                    <!-- Sélection client et dépôt -->
                                    <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                                        <div style="flex: 1;">
                                            <label style="font-size: 12px; color: #6c757d;">Client</label>
                                            <select name="client_id" class="form-control-sm" style="width: 100%;">
                                                <option value="">-- Sélectionner un client --</option>
                                                @foreach($clients as $c)
                                                    <option value="{{ $c->id }}">{{ ucfirst($c->nom) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="display: flex; align-items: end;">
                                            <div style="flex: 1;">
                                                <input type="text" name="client" class="form-control">
                                            </div>
                                        </div>
                                            
                                    </div>

                                    <!-- Produits par catégorie (exemple statique, adaptez selon vos données) -->
                                    <div class="category-header">
                                        <i class="fas fa-box"></i> services
                                    </div>
                                    <div class="product-grid" id="productGridShoes">
                                        @foreach($services->take(15) as $service)
                                            <div class="product-card" data-id="{{ $service->id }}" data-prix="{{ $service->prix }}" data-nom="{{ $service->nom }}">
                                                <!--<div class="product-image">
                                                    <img src="{{ asset('storage/'.$service->image) }}" width="20">
                                                </div>-->
                                                <div class="product-name">{{ $service->nom }}</div>
                                                <div class="product-price">{{ number_format($service->prix, 0, ',', ' ') }} CFA</div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="category-header">
                                        <i class="fas fa-shopping-cart"></i> Panier
                                    </div>

                                    <!-- Tableau des services du panier -->
                                    <table class="services-table" id="servicesTable">
                                        <thead>
                                            <tr>
                                                <th>Produit</th>
                                                <th>prix unit.</th>
                                                <th>Qté</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="panierRows">
                                            <tr id="row-0">
                                                <td>
                                                    <input type="text" name="services[0][designation]" class="form-control-sm designation" style="width: 100px;">
                                                </td>
                                                <td>
                                                    <input type="number" name="services[0][prix]" class="form-control-sm prix" step="any" style="width: 100px;">
                                                </td>
                                                <td>
                                                    <input type="number" name="services[0][quantite]" class="form-control-sm quantite" value="1" style="width: 80px;">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control-sm total-ligne" readonly style="width: 100px; background:#f8f9fa;">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn-icon remove-row">🗑️</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="button" id="addRowBtn" class="btn btn-primary" style="margin-top: 15px; width: 100%;">
                                        + Ajouter un service
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- COLONNE DROITE : Résumé et Paiement -->
                        <div class="pos-right">
                            <div class="pos-card">
                                <div class="pos-card-header">Récapitulatif</div>
                                <div class="pos-card-body">
                                    <div class="summary-line">
                                        <span>Sous-total</span>
                                        <span id="subtotal">0</span> CFA
                                    </div>
                                    <!--<div class="tax-box">
                                        <div class="summary-line">
                                            <span>Taxes (TVA 18%)</span>
                                            <span id="taxAmount">0</span> CFA
                                        </div>
                                    </div>-->
                                    <div class="summary-total">
                                        <span>TOTAL TTC</span>
                                        <span id="totalGlobal">0</span> CFA
                                    </div>

                                    <!-- Suggestions combos -->
                                    <div style="margin-top: 20px;">
                                        <div class="category-header" style="margin-bottom: 10px;">🔥 Combos populaires</div>
                                        <div>
                                            @foreach($services->take(4) as $combo)
                                                <span class="badge-combo">{{ $combo->nom }}</span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Module client / Paiement -->
                                    <div class="client-pad">
                                        <div style="font-weight: 600; margin-bottom: 10px;">👤 Paiement</div>
                                        <!--<div class="numpad" id="numpad">
                                            <div class="num-btn" data-value="1">1</div>
                                            <div class="num-btn" data-value="2">2</div>
                                            <div class="num-btn" data-value="3">3</div>
                                            <div class="num-btn" data-value="4">4</div>
                                            <div class="num-btn" data-value="5">5</div>
                                            <div class="num-btn" data-value="6">6</div>
                                            <div class="num-btn" data-value="7">7</div>
                                            <div class="num-btn" data-value="8">8</div>
                                            <div class="num-btn" data-value="9">9</div>
                                            <div class="num-btn" data-value="0">0</div>
                                            <div class="num-btn" data-value=".">.</div>
                                            <div class="num-btn" data-value="clear">⌫</div>
                                        </div>
                                        <input type="text" id="montantPaye" name="montant" class="form-control-sm" placeholder="Montant reçu" style="width: 100%; margin-bottom: 10px;">-->
                                        
                                        <div class="action-buttons">
                                            <a href="{{ route('dashboard') }}" class="btn-custom btn-secondary-custom" style="text-align: center; text-decoration: none;">Annuler</a>
                                            <button type="submit" class="btn-custom btn-primary-custom">Valider ✅</button>
                                        </div>
                                        <div class="text-muted-small">
                                            montant calcule automatiquement
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- JS Service -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('serviceEditModal');
            const form = document.getElementById('editServiceForm');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Récupération des données
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = button.getAttribute('data-price');
                const description = button.getAttribute('data-description');
                const image = button.getAttribute('data-image');
                
                // Remplir le formulaire
                modal.querySelector('#service_id').value = id;
                modal.querySelector('#name').value = name;
                modal.querySelector('#price').value = price;
                modal.querySelector('#description').value = description;
                modal.querySelector('#image').src = image;
                
                // Mettre à jour l'action du formulaire avec l'ID récupéré
                const updateUrl = `/service/${id}`;
                form.action = updateUrl;
            });
        });
    </script>

    <!-- JS Facture -->
    <script>
        let rowIndex = 1;

        // Ajout produit via clic sur carte produit
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function() {
                let productId = this.dataset.id;
                let productName = this.dataset.nom;
                let productPrice = this.dataset.prix;

                // Chercher une ligne vide ou ajouter une nouvelle ligne
                let selectElement = document.querySelector('#panierRows select');
                if(selectElement && selectElement.value === "") {
                    // Remplir la première ligne vide
                    let row = selectElement.closest('tr');
                    selectElement.value = productId;
                    row.querySelector('.prix').value = productPrice;
                    row.querySelector('.quantite').value = 1;
                    calculLigne(row);
                } else {
                    // Ajouter une nouvelle ligne
                    addNewRow(productId, productPrice);
                }
            });
        });

        // Ajouter une nouvelle ligne
        function addNewRow(serviceId = null, price = null) {
            let options = `{!! $services->map(function($s) { return '<input value="'.$s->id.'" data-prix="'.$s->prix.'" data-nom="'.$s->nom.'">'; })->implode('') !!}`;
            
            let rowHtml = `
                <tr id="row-${rowIndex}">
                    <td>
                        <input type="text" name="services[${rowIndex}][designation]" class="form-control-sm designation" style="width: 100px;">
                    </td>
                    <td>
                        <input type="number" name="services[${rowIndex}][prix]" class="form-control-sm prix" step="any" style="width: 100px;">
                    </td>
                    <td>
                        <input type="number" name="services[${rowIndex}][quantite]" class="form-control-sm quantite" value="1" style="width: 80px;">
                    </td>
                    <td>
                        <input type="number" class="form-control-sm total-ligne" readonly style="width: 100px; background:#f8f9fa;">
                    </td>
                    <td>
                        <button type="button" class="btn-icon remove-row">🗑️</button>
                    </td>
                </tr>
            `;
            document.querySelector('#panierRows').insertAdjacentHTML('beforeend', rowHtml);
            
            if(serviceId && price) {
                let newRow = document.querySelector(`#row-${rowIndex}`);
                let select = newRow.querySelector('.produit-select');
                select.value = serviceId;
                newRow.querySelector('.prix').value = price;
                calculLigne(newRow);
            }
            
            rowIndex++;
        }

        // Suppression de ligne
        document.addEventListener('click', function(e) {
            if(e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
                calculTotalGlobal();
            }
        });

        // Auto-remplissage prix
        document.addEventListener('change', function(e) {
            if(e.target.classList.contains('produit-select')) {
                let selected = e.target.selectedOptions[0];
                let prix = selected.dataset.prix;
                let row = e.target.closest('tr');
                row.querySelector('.prix').value = prix;
                calculLigne(row);
            }
        });

        // Calcul à la saisie de quantité
        document.addEventListener('input', function(e) {
            if(e.target.classList.contains('quantite')) {
                let row = e.target.closest('tr');
                calculLigne(row);
            }
        });

        function calculLigne(row) {
            let prix = parseFloat(row.querySelector('.prix').value) || 0;
            let qte = parseFloat(row.querySelector('.quantite').value) || 0;
            let total = prix * qte;
            row.querySelector('.total-ligne').value = total.toFixed(0);
            calculTotalGlobal();
        }

        function calculTotalGlobal() {
            let totalHT = 0;
            document.querySelectorAll('.total-ligne').forEach(input => {
                totalHT += parseFloat(input.value) || 0;
            });
            
            let tva = totalHT * 0;
            let totalTTC = totalHT + tva;
            
            document.getElementById('subtotal').innerText = totalHT.toLocaleString();
            document.getElementById('totalGlobal').innerText = totalTTC.toLocaleString();
        }

        // Bouton ajouter ligne
        document.getElementById('addRowBtn').addEventListener('click', function() {
            addNewRow();
        });

        // Numpad virtuel
        let montantInput = document.getElementById('montantPaye');
        document.querySelectorAll('.num-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                let value = this.dataset.value;
                if(value === 'clear') {
                    montantInput.value = montantInput.value.slice(0, -1);
                } else {
                    montantInput.value += value;
                }
            });
        });
        
    </script>

    <!--JS client  -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('clientEditModal');
            const form = document.getElementById('editClientForm');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;

                // Récupération des données
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const phone = button.getAttribute('data-phone');
                const adress = button.getAttribute('data-adress');
                
                // Remplir le formulaire
                modal.querySelector('#client_id').value = id;
                modal.querySelector('#name').value = name;
                modal.querySelector('#phone').value = phone;
                modal.querySelector('#email').value = email;
                modal.querySelector('#adress').value = adress;
                
                // Mettre à jour l'action du formulaire avec l'ID récupéré
                const updateUrl = `/client/${id}`;
                form.action = updateUrl;
            });
        });
    </script>

    <!-- JS Achat-Form -->
    <script>

        let indexs = 1;

        // Ajouter ligne
            document.getElementById('addRows').addEventListener('click', function () {

                let rows = `
                <tr>
                    <td>
                        <input type="text" name="services[${indexs}][designation]" class="form-control" placeholder="designation">

                    </td>

                    <td>
                        <input type="number" name="services[${indexs}][prix]" class="form-control prix" >
                    </td>

                    <td>
                        <input type="number" name="services[${indexs}][quantite]" class="form-control quantite" value="1">
                    </td>

                    <td>
                        <input type="number" class="form-control total-ligne" readonly>
                    </td>

                    <td>
                        <button type="button" class="btn btn-danger remove">X</button>
                    </td>
                </tr>
                `;

                document.querySelector('#table-achats tbody').insertAdjacentHTML('beforeend', rows);
                indexs++;
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


    <!-- JS Devis-Form -->
    <script>
        let index = 1;

        // Ajouter ligne
        document.getElementById('addRow').addEventListener('click', function () {

            let row = `
            <tr>
                <td>
                    <input type="text" name="services[${index}][designation]" class="form-control" placeholder="designation">

                </td>

                <td>
                    <input type="number" name="services[${index}][prix]" class="form-control prix" >
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

    <!-- JS panel -->
    <script>
        // Gestion des onglets
        const tabs = document.querySelectorAll('.tab-btn');
        const panes = document.querySelectorAll('.tab-pane');
        tabs.forEach(btn => {
            btn.addEventListener('click', () => {
            const tabId = btn.getAttribute('data-tab');
            tabs.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            panes.forEach(pane => pane.classList.remove('active-pane'));
            document.getElementById(tabId).classList.add('active-pane');
            });
        });

        loadFromLocal();
    </script>
   

</x-app-layout>

</body>
</html>