<?php
// Earnings Calendar - Top 40 Stocks by Market Cap
// Pagina standalone, non richiede autenticazione o database
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings Calendar - Top 40 Stocks</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
/* ========== Reset & Base ========== */
*, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --bg-primary: #0a0e17;
    --bg-secondary: #111827;
    --bg-card: #1a2332;
    --bg-card-hover: #1f2b3d;
    --border: #2a3548;
    --text-primary: #f1f5f9;
    --text-secondary: #94a3b8;
    --text-muted: #64748b;
    --accent: #3b82f6;
    --accent-light: #60a5fa;
    --green: #22c55e;
    --green-bg: rgba(34, 197, 94, 0.1);
    --orange: #f59e0b;
    --orange-bg: rgba(245, 158, 11, 0.1);
    --red: #ef4444;
    --red-bg: rgba(239, 68, 68, 0.1);
    --purple: #a855f7;
    --purple-bg: rgba(168, 85, 247, 0.1);
    --radius: 12px;
    --radius-sm: 8px;
    --shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    line-height: 1.6;
    min-height: 100vh;
}

/* ========== Header ========== */
.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 32px;
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 100;
    backdrop-filter: blur(12px);
    flex-wrap: wrap;
    gap: 12px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo { color: var(--accent); }

.header h1 {
    font-size: 1.25rem;
    font-weight: 600;
    letter-spacing: -0.02em;
}

.badge {
    background: var(--accent);
    color: white;
    font-size: 0.7rem;
    font-weight: 600;
    padding: 2px 8px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.header-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 8px 14px;
    transition: border-color 0.2s;
}

.search-box:focus-within { border-color: var(--accent); }
.search-box svg { color: var(--text-muted); flex-shrink: 0; }

.search-box input {
    background: none;
    border: none;
    outline: none;
    color: var(--text-primary);
    font-size: 0.875rem;
    width: 200px;
    font-family: inherit;
}

.search-box input::placeholder { color: var(--text-muted); }

.view-toggle {
    display: flex;
    background: var(--bg-primary);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    overflow: hidden;
}

.view-btn {
    background: none;
    border: none;
    padding: 8px 12px;
    color: var(--text-muted);
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
}

.view-btn.active { background: var(--accent); color: white; }
.view-btn:hover:not(.active) { color: var(--text-primary); }

/* ========== Stats Bar ========== */
.stats-bar {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1px;
    background: var(--border);
    border-bottom: 1px solid var(--border);
}

.stat {
    background: var(--bg-secondary);
    padding: 16px 24px;
    text-align: center;
}

.stat-label {
    display: block;
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
}

.stat-value {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--accent-light);
}

/* ========== Filters ========== */
.filters {
    display: flex;
    gap: 8px;
    padding: 16px 32px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.filter-btn {
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    color: var(--text-secondary);
    padding: 8px 18px;
    border-radius: 20px;
    font-size: 0.8125rem;
    font-family: inherit;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    white-space: nowrap;
}

.filter-btn:hover { border-color: var(--accent); color: var(--text-primary); }
.filter-btn.active { background: var(--accent); border-color: var(--accent); color: white; }

/* ========== Sort Controls ========== */
.sort-controls {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0 32px 16px;
}

.sort-label { font-size: 0.8125rem; color: var(--text-muted); }

#sortSelect {
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    color: var(--text-primary);
    padding: 6px 12px;
    border-radius: var(--radius-sm);
    font-family: inherit;
    font-size: 0.8125rem;
    cursor: pointer;
    outline: none;
}

#sortSelect:focus { border-color: var(--accent); }
#sortSelect option { background: var(--bg-secondary); }

/* ========== Loading ========== */
.loading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 80px 20px;
    gap: 16px;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 3px solid var(--border);
    border-top-color: var(--accent);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }
.loading p { color: var(--text-muted); font-size: 0.875rem; }

/* ========== Error State ========== */
.error-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 80px 20px;
    gap: 16px;
    color: var(--text-muted);
}

.retry-btn {
    background: var(--accent);
    border: none;
    color: white;
    padding: 10px 24px;
    border-radius: var(--radius-sm);
    font-family: inherit;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: opacity 0.2s;
}

.retry-btn:hover { opacity: 0.9; }

/* ========== Grid View ========== */
.grid-view {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 16px;
    padding: 0 32px 32px;
}

.card {
    background: var(--bg-card);
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px;
    transition: all 0.25s ease;
    position: relative;
    overflow: hidden;
}

.card:hover {
    background: var(--bg-card-hover);
    border-color: var(--accent);
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 14px;
}

.card-ticker { font-size: 1.25rem; font-weight: 700; color: var(--text-primary); }
.card-rank { font-size: 0.7rem; color: var(--text-muted); background: var(--bg-primary); padding: 2px 8px; border-radius: 12px; font-weight: 500; }
.card-name { font-size: 0.8125rem; color: var(--text-secondary); margin-bottom: 4px; line-height: 1.4; }
.card-sector { display: inline-block; font-size: 0.7rem; color: var(--purple); background: var(--purple-bg); padding: 2px 8px; border-radius: 12px; margin-bottom: 16px; }
.card-divider { height: 1px; background: var(--border); margin-bottom: 16px; }
.card-earnings { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }
.earnings-date { font-size: 0.9375rem; font-weight: 600; }

.earnings-timing {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 12px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.timing-bmo { color: var(--orange); background: var(--orange-bg); }
.timing-amc { color: var(--purple); background: var(--purple-bg); }
.timing-unknown { color: var(--text-muted); background: var(--bg-primary); }

.card-meta { display: flex; justify-content: space-between; align-items: center; }
.market-cap { font-size: 0.8125rem; color: var(--text-muted); }
.countdown { font-size: 0.8125rem; font-weight: 500; }
.countdown-soon { color: var(--red); }
.countdown-near { color: var(--orange); }
.countdown-far { color: var(--green); }
.countdown-passed { color: var(--text-muted); }

.card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 3px; }
.card.urgency-soon::before { background: linear-gradient(90deg, var(--red), transparent); }
.card.urgency-near::before { background: linear-gradient(90deg, var(--orange), transparent); }
.card.urgency-far::before { background: linear-gradient(90deg, var(--green), transparent); }

/* ========== List View ========== */
.list-view { padding: 0 32px 32px; overflow-x: auto; }
.list-view table { width: 100%; border-collapse: collapse; min-width: 800px; }

.list-view thead th {
    text-align: left;
    padding: 12px 16px;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 1px solid var(--border);
    background: var(--bg-secondary);
    position: sticky;
    top: 0;
}

.list-view tbody tr { border-bottom: 1px solid var(--border); transition: background 0.15s; }
.list-view tbody tr:hover { background: var(--bg-card-hover); }
.list-view tbody td { padding: 14px 16px; font-size: 0.875rem; }
.list-view .ticker-cell { font-weight: 700; color: var(--accent-light); }
.list-view .sector-cell { color: var(--purple); font-size: 0.8125rem; }
.list-view .cap-cell { color: var(--text-secondary); }
.list-view .date-cell { font-weight: 600; }

/* ========== Footer ========== */
.footer {
    text-align: center;
    padding: 24px 32px;
    border-top: 1px solid var(--border);
    color: var(--text-muted);
    font-size: 0.75rem;
}

/* ========== Responsive ========== */
@media (max-width: 768px) {
    .header { padding: 12px 16px; }
    .stats-bar { grid-template-columns: repeat(2, 1fr); }
    .filters { padding: 12px 16px; }
    .sort-controls { padding: 0 16px 12px; }
    .grid-view { grid-template-columns: 1fr; padding: 0 16px 16px; }
    .list-view { padding: 0 16px 16px; }
    .search-box input { width: 140px; }
}

@media (max-width: 480px) {
    .header-left h1 { font-size: 1rem; }
    .search-box input { width: 100px; }
    .stat { padding: 12px 16px; }
    .stat-value { font-size: 1rem; }
}

::-webkit-scrollbar { width: 6px; height: 6px; }
::-webkit-scrollbar-track { background: var(--bg-primary); }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
::-webkit-scrollbar-thumb:hover { background: var(--text-muted); }

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.card, .list-view tbody tr { animation: fadeIn 0.3s ease forwards; }
.grid-view .card:nth-child(n) { animation-delay: calc(var(--i, 0) * 0.04s); }
    </style>
</head>
<body>
    <div class="app">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <div class="logo">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                    </svg>
                </div>
                <h1>Earnings Calendar</h1>
                <span class="badge">Top 40</span>
            </div>
            <div class="header-right">
                <div class="search-box">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Cerca ticker o nome...">
                </div>
                <div class="view-toggle">
                    <button id="btnGrid" class="view-btn active" title="Vista griglia">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect></svg>
                    </button>
                    <button id="btnList" class="view-btn" title="Vista lista">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- Stats bar -->
        <div class="stats-bar">
            <div class="stat">
                <span class="stat-label">Prossimi 7 giorni</span>
                <span class="stat-value" id="next7days">-</span>
            </div>
            <div class="stat">
                <span class="stat-label">Prossimi 30 giorni</span>
                <span class="stat-value" id="next30days">-</span>
            </div>
            <div class="stat">
                <span class="stat-label">Questa settimana</span>
                <span class="stat-value" id="thisWeek">-</span>
            </div>
            <div class="stat">
                <span class="stat-label">Ultimo aggiornamento</span>
                <span class="stat-value" id="lastUpdate">-</span>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <button class="filter-btn active" data-filter="all">Tutti</button>
            <button class="filter-btn" data-filter="thisWeek">Questa settimana</button>
            <button class="filter-btn" data-filter="nextWeek">Prossima settimana</button>
            <button class="filter-btn" data-filter="thisMonth">Questo mese</button>
            <button class="filter-btn" data-filter="bmo">Pre-market</button>
            <button class="filter-btn" data-filter="amc">After-market</button>
        </div>

        <!-- Sort controls -->
        <div class="sort-controls">
            <span class="sort-label">Ordina per:</span>
            <select id="sortSelect">
                <option value="date-asc">Data (prossimi prima)</option>
                <option value="date-desc">Data (ultimi prima)</option>
                <option value="cap-desc">Cap. di mercato (decrescente)</option>
                <option value="cap-asc">Cap. di mercato (crescente)</option>
                <option value="name-asc">Nome (A-Z)</option>
            </select>
        </div>

        <!-- Loading state -->
        <div id="loading" class="loading">
            <div class="spinner"></div>
            <p>Caricamento dati earnings...</p>
        </div>

        <!-- Error state -->
        <div id="error" class="error-state" style="display:none">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <p id="errorMsg">Errore nel caricamento dei dati</p>
            <button onclick="location.reload()" class="retry-btn">Riprova</button>
        </div>

        <!-- Grid view -->
        <div id="gridView" class="grid-view" style="display:none"></div>

        <!-- List view -->
        <div id="listView" class="list-view" style="display:none">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ticker</th>
                        <th>Azienda</th>
                        <th>Settore</th>
                        <th>Cap. Mercato</th>
                        <th>Data Earnings</th>
                        <th>Orario</th>
                        <th>Countdown</th>
                    </tr>
                </thead>
                <tbody id="listBody"></tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <p>I dati sulle date degli earnings sono indicativi e soggetti a variazioni. Verificare sempre con fonti ufficiali.</p>
    </footer>

    <script>
// Top 40 stocks by market cap
const TOP_40_STOCKS = [
  { ticker: "AAPL",  name: "Apple Inc.",                    sector: "Technology",        marketCap: 3520, earningsDate: "2026-04-30", timing: "amc" },
  { ticker: "MSFT",  name: "Microsoft Corporation",         sector: "Technology",        marketCap: 3180, earningsDate: "2026-04-22", timing: "amc" },
  { ticker: "NVDA",  name: "NVIDIA Corporation",            sector: "Technology",        marketCap: 3050, earningsDate: "2026-02-26", timing: "amc" },
  { ticker: "GOOG",  name: "Alphabet Inc. (Google)",        sector: "Technology",        marketCap: 2350, earningsDate: "2026-04-28", timing: "amc" },
  { ticker: "AMZN",  name: "Amazon.com Inc.",               sector: "Consumer Cyclical", marketCap: 2280, earningsDate: "2026-04-24", timing: "amc" },
  { ticker: "META",  name: "Meta Platforms Inc.",            sector: "Technology",        marketCap: 1750, earningsDate: "2026-04-23", timing: "amc" },
  { ticker: "BRK.B", name: "Berkshire Hathaway Inc.",       sector: "Financial",         marketCap: 1120, earningsDate: "2026-05-02", timing: "bmo" },
  { ticker: "TSLA",  name: "Tesla Inc.",                    sector: "Consumer Cyclical", marketCap: 1080, earningsDate: "2026-04-22", timing: "amc" },
  { ticker: "LLY",   name: "Eli Lilly and Company",         sector: "Healthcare",        marketCap: 820,  earningsDate: "2026-04-24", timing: "bmo" },
  { ticker: "TSM",   name: "Taiwan Semiconductor",          sector: "Technology",        marketCap: 810,  earningsDate: "2026-04-17", timing: "bmo" },
  { ticker: "AVGO",  name: "Broadcom Inc.",                 sector: "Technology",        marketCap: 790,  earningsDate: "2026-03-06", timing: "amc" },
  { ticker: "JPM",   name: "JPMorgan Chase & Co.",          sector: "Financial",         marketCap: 740,  earningsDate: "2026-04-11", timing: "bmo" },
  { ticker: "V",     name: "Visa Inc.",                     sector: "Financial",         marketCap: 630,  earningsDate: "2026-04-22", timing: "amc" },
  { ticker: "WMT",   name: "Walmart Inc.",                  sector: "Consumer Defensive",marketCap: 610,  earningsDate: "2026-02-20", timing: "bmo" },
  { ticker: "UNH",   name: "UnitedHealth Group Inc.",       sector: "Healthcare",        marketCap: 590,  earningsDate: "2026-04-15", timing: "bmo" },
  { ticker: "XOM",   name: "Exxon Mobil Corporation",       sector: "Energy",            marketCap: 560,  earningsDate: "2026-04-25", timing: "bmo" },
  { ticker: "MA",    name: "Mastercard Incorporated",       sector: "Financial",         marketCap: 480,  earningsDate: "2026-04-29", timing: "bmo" },
  { ticker: "ORCL",  name: "Oracle Corporation",            sector: "Technology",        marketCap: 470,  earningsDate: "2026-03-10", timing: "amc" },
  { ticker: "PG",    name: "Procter & Gamble Co.",          sector: "Consumer Defensive",marketCap: 460,  earningsDate: "2026-04-17", timing: "bmo" },
  { ticker: "COST",  name: "Costco Wholesale Corp.",        sector: "Consumer Defensive",marketCap: 440,  earningsDate: "2026-03-06", timing: "amc" },
  { ticker: "JNJ",   name: "Johnson & Johnson",             sector: "Healthcare",        marketCap: 430,  earningsDate: "2026-04-15", timing: "bmo" },
  { ticker: "HD",    name: "The Home Depot Inc.",            sector: "Consumer Cyclical", marketCap: 420,  earningsDate: "2026-02-25", timing: "bmo" },
  { ticker: "NFLX",  name: "Netflix Inc.",                  sector: "Technology",        marketCap: 410,  earningsDate: "2026-04-17", timing: "amc" },
  { ticker: "ABBV",  name: "AbbVie Inc.",                   sector: "Healthcare",        marketCap: 390,  earningsDate: "2026-04-25", timing: "bmo" },
  { ticker: "BAC",   name: "Bank of America Corp.",         sector: "Financial",         marketCap: 370,  earningsDate: "2026-04-15", timing: "bmo" },
  { ticker: "CRM",   name: "Salesforce Inc.",               sector: "Technology",        marketCap: 360,  earningsDate: "2026-02-26", timing: "amc" },
  { ticker: "CVX",   name: "Chevron Corporation",           sector: "Energy",            marketCap: 340,  earningsDate: "2026-04-25", timing: "bmo" },
  { ticker: "KO",    name: "The Coca-Cola Company",         sector: "Consumer Defensive",marketCap: 320,  earningsDate: "2026-04-21", timing: "bmo" },
  { ticker: "MRK",   name: "Merck & Co. Inc.",              sector: "Healthcare",        marketCap: 310,  earningsDate: "2026-04-24", timing: "bmo" },
  { ticker: "AMD",   name: "Advanced Micro Devices",        sector: "Technology",        marketCap: 300,  earningsDate: "2026-04-29", timing: "amc" },
  { ticker: "PEP",   name: "PepsiCo Inc.",                  sector: "Consumer Defensive",marketCap: 280,  earningsDate: "2026-04-22", timing: "bmo" },
  { ticker: "TMO",   name: "Thermo Fisher Scientific",      sector: "Healthcare",        marketCap: 270,  earningsDate: "2026-04-23", timing: "bmo" },
  { ticker: "ADBE",  name: "Adobe Inc.",                    sector: "Technology",        marketCap: 265,  earningsDate: "2026-03-12", timing: "amc" },
  { ticker: "LIN",   name: "Linde plc",                    sector: "Materials",         marketCap: 260,  earningsDate: "2026-04-28", timing: "bmo" },
  { ticker: "ACN",   name: "Accenture plc",                sector: "Technology",        marketCap: 255,  earningsDate: "2026-03-20", timing: "bmo" },
  { ticker: "WFC",   name: "Wells Fargo & Company",         sector: "Financial",         marketCap: 250,  earningsDate: "2026-04-11", timing: "bmo" },
  { ticker: "MCD",   name: "McDonald's Corporation",        sector: "Consumer Cyclical", marketCap: 245,  earningsDate: "2026-04-28", timing: "bmo" },
  { ticker: "CSCO",  name: "Cisco Systems Inc.",            sector: "Technology",        marketCap: 240,  earningsDate: "2026-02-19", timing: "amc" },
  { ticker: "ABT",   name: "Abbott Laboratories",           sector: "Healthcare",        marketCap: 235,  earningsDate: "2026-04-16", timing: "bmo" },
  { ticker: "DHR",   name: "Danaher Corporation",           sector: "Healthcare",        marketCap: 230,  earningsDate: "2026-04-22", timing: "bmo" }
];

// ============================================================
// Utility functions
// ============================================================

function formatMarketCap(capInBillions) {
  if (capInBillions >= 1000) return `$${(capInBillions / 1000).toFixed(2)}T`;
  return `$${capInBillions}B`;
}

function formatDate(dateStr) {
  const date = new Date(dateStr + "T00:00:00");
  return date.toLocaleDateString("it-IT", { day: "numeric", month: "short", year: "numeric" });
}

function formatDateShort(dateStr) {
  const date = new Date(dateStr + "T00:00:00");
  return date.toLocaleDateString("it-IT", { day: "numeric", month: "short" });
}

function getDaysUntil(dateStr) {
  const today = new Date(); today.setHours(0, 0, 0, 0);
  const target = new Date(dateStr + "T00:00:00");
  return Math.ceil((target - today) / (1000 * 60 * 60 * 24));
}

function getCountdownText(days) {
  if (days < 0) return "Passato";
  if (days === 0) return "Oggi!";
  if (days === 1) return "Domani";
  if (days <= 7) return `${days} giorni`;
  if (days <= 30) { const w = Math.floor(days / 7); return `${w} sett.${days % 7 > 0 ? ` ${days % 7}g` : ""}`; }
  return `${days} giorni`;
}

function getCountdownClass(days) {
  if (days < 0) return "countdown-passed";
  if (days <= 3) return "countdown-soon";
  if (days <= 14) return "countdown-near";
  return "countdown-far";
}

function getUrgencyClass(days) {
  if (days <= 3) return "urgency-soon";
  if (days <= 14) return "urgency-near";
  return "urgency-far";
}

function getTimingLabel(t) { return t === "bmo" ? "Pre-Market" : t === "amc" ? "After-Market" : "TBD"; }
function getTimingClass(t) { return t === "bmo" ? "timing-bmo" : t === "amc" ? "timing-amc" : "timing-unknown"; }

function isThisWeek(dateStr) {
  const today = new Date(), dow = today.getDay();
  const start = new Date(today); start.setDate(today.getDate() - (dow === 0 ? 6 : dow - 1)); start.setHours(0,0,0,0);
  const end = new Date(start); end.setDate(start.getDate() + 6); end.setHours(23,59,59,999);
  const t = new Date(dateStr + "T12:00:00");
  return t >= start && t <= end;
}

function isNextWeek(dateStr) {
  const today = new Date(), dow = today.getDay();
  const start = new Date(today); start.setDate(today.getDate() + (7 - (dow === 0 ? 6 : dow - 1))); start.setHours(0,0,0,0);
  const end = new Date(start); end.setDate(start.getDate() + 6); end.setHours(23,59,59,999);
  const t = new Date(dateStr + "T12:00:00");
  return t >= start && t <= end;
}

function isThisMonth(dateStr) {
  const today = new Date(), t = new Date(dateStr + "T12:00:00");
  return t.getMonth() === today.getMonth() && t.getFullYear() === today.getFullYear();
}

// ============================================================
// App state
// ============================================================
let currentView = "grid", currentFilter = "all", currentSort = "date-asc", searchQuery = "", stocks = [];

function initData() {
  stocks = TOP_40_STOCKS.map((s, i) => ({ ...s, rank: i + 1, daysUntil: getDaysUntil(s.earningsDate) }));
}

function getFilteredStocks() {
  let f = [...stocks];
  if (searchQuery) {
    const q = searchQuery.toLowerCase();
    f = f.filter(s => s.ticker.toLowerCase().includes(q) || s.name.toLowerCase().includes(q) || s.sector.toLowerCase().includes(q));
  }
  switch (currentFilter) {
    case "thisWeek": f = f.filter(s => isThisWeek(s.earningsDate)); break;
    case "nextWeek": f = f.filter(s => isNextWeek(s.earningsDate)); break;
    case "thisMonth": f = f.filter(s => isThisMonth(s.earningsDate)); break;
    case "bmo": f = f.filter(s => s.timing === "bmo"); break;
    case "amc": f = f.filter(s => s.timing === "amc"); break;
  }
  switch (currentSort) {
    case "date-asc": f.sort((a, b) => a.daysUntil - b.daysUntil); break;
    case "date-desc": f.sort((a, b) => b.daysUntil - a.daysUntil); break;
    case "cap-desc": f.sort((a, b) => b.marketCap - a.marketCap); break;
    case "cap-asc": f.sort((a, b) => a.marketCap - b.marketCap); break;
    case "name-asc": f.sort((a, b) => a.name.localeCompare(b.name)); break;
  }
  return f;
}

// ============================================================
// Rendering
// ============================================================

function renderGrid(data) {
  const c = document.getElementById("gridView");
  if (!data.length) { c.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--text-muted)">Nessun risultato trovato</div>'; return; }
  c.innerHTML = data.map((s, i) => `
    <div class="card ${getUrgencyClass(s.daysUntil)}" style="--i:${i}">
      <div class="card-header"><span class="card-ticker">${s.ticker}</span><span class="card-rank">#${s.rank}</span></div>
      <div class="card-name">${s.name}</div>
      <span class="card-sector">${s.sector}</span>
      <div class="card-divider"></div>
      <div class="card-earnings"><span class="earnings-date">${formatDate(s.earningsDate)}</span><span class="earnings-timing ${getTimingClass(s.timing)}">${getTimingLabel(s.timing)}</span></div>
      <div class="card-meta"><span class="market-cap">${formatMarketCap(s.marketCap)}</span><span class="countdown ${getCountdownClass(s.daysUntil)}">${getCountdownText(s.daysUntil)}</span></div>
    </div>`).join("");
}

function renderList(data) {
  const tb = document.getElementById("listBody");
  if (!data.length) { tb.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)">Nessun risultato trovato</td></tr>'; return; }
  tb.innerHTML = data.map(s => `
    <tr>
      <td>${s.rank}</td><td class="ticker-cell">${s.ticker}</td><td>${s.name}</td>
      <td class="sector-cell">${s.sector}</td><td class="cap-cell">${formatMarketCap(s.marketCap)}</td>
      <td class="date-cell">${formatDate(s.earningsDate)}</td>
      <td><span class="earnings-timing ${getTimingClass(s.timing)}">${getTimingLabel(s.timing)}</span></td>
      <td><span class="countdown ${getCountdownClass(s.daysUntil)}">${getCountdownText(s.daysUntil)}</span></td>
    </tr>`).join("");
}

function renderStats() {
  const in7 = stocks.filter(s => s.daysUntil >= 0 && s.daysUntil <= 7).length;
  const in30 = stocks.filter(s => s.daysUntil >= 0 && s.daysUntil <= 30).length;
  const thisW = stocks.filter(s => isThisWeek(s.earningsDate)).length;
  document.getElementById("next7days").textContent = in7;
  document.getElementById("next30days").textContent = in30;
  document.getElementById("thisWeek").textContent = thisW;
  document.getElementById("lastUpdate").textContent = formatDateShort(new Date().toISOString().split("T")[0]);
}

function render() {
  const data = getFilteredStocks();
  const gv = document.getElementById("gridView"), lv = document.getElementById("listView");
  if (currentView === "grid") { gv.style.display = "grid"; lv.style.display = "none"; renderGrid(data); }
  else { gv.style.display = "none"; lv.style.display = "block"; renderList(data); }
  renderStats();
}

// ============================================================
// Event listeners
// ============================================================

function setupEventListeners() {
  document.getElementById("btnGrid").addEventListener("click", () => { currentView = "grid"; document.getElementById("btnGrid").classList.add("active"); document.getElementById("btnList").classList.remove("active"); render(); });
  document.getElementById("btnList").addEventListener("click", () => { currentView = "list"; document.getElementById("btnList").classList.add("active"); document.getElementById("btnGrid").classList.remove("active"); render(); });
  document.getElementById("searchInput").addEventListener("input", e => { searchQuery = e.target.value; render(); });
  document.querySelectorAll(".filter-btn").forEach(btn => {
    btn.addEventListener("click", () => { document.querySelectorAll(".filter-btn").forEach(b => b.classList.remove("active")); btn.classList.add("active"); currentFilter = btn.dataset.filter; render(); });
  });
  document.getElementById("sortSelect").addEventListener("change", e => { currentSort = e.target.value; render(); });
}

// ============================================================
// Boot
// ============================================================

document.addEventListener("DOMContentLoaded", function() {
  const loading = document.getElementById("loading"), errorEl = document.getElementById("error");
  try {
    initData();
    setupEventListeners();
    setTimeout(() => { loading.style.display = "none"; render(); }, 600);
  } catch (err) {
    loading.style.display = "none";
    errorEl.style.display = "flex";
    document.getElementById("errorMsg").textContent = err.message;
  }
});
    </script>
</body>
</html>
