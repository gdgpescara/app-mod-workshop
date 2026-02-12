// ============================================================
// Earnings Calendar - Top 40 Stocks by Market Cap
// ============================================================

// Top 40 stocks by market cap with estimated earnings dates.
// In a production app these would come from a financial API
// (e.g. Alpha Vantage, Financial Modeling Prep, Yahoo Finance).
// Here we use curated data that can be refreshed periodically.

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
  if (capInBillions >= 1000) {
    return `$${(capInBillions / 1000).toFixed(2)}T`;
  }
  return `$${capInBillions}B`;
}

function formatDate(dateStr) {
  const date = new Date(dateStr + "T00:00:00");
  const options = { day: "numeric", month: "short", year: "numeric" };
  return date.toLocaleDateString("it-IT", options);
}

function formatDateShort(dateStr) {
  const date = new Date(dateStr + "T00:00:00");
  const options = { day: "numeric", month: "short" };
  return date.toLocaleDateString("it-IT", options);
}

function getDaysUntil(dateStr) {
  const today = new Date();
  today.setHours(0, 0, 0, 0);
  const target = new Date(dateStr + "T00:00:00");
  const diff = target - today;
  return Math.ceil(diff / (1000 * 60 * 60 * 24));
}

function getCountdownText(days) {
  if (days < 0) return "Passato";
  if (days === 0) return "Oggi!";
  if (days === 1) return "Domani";
  if (days <= 7) return `${days} giorni`;
  if (days <= 30) {
    const weeks = Math.floor(days / 7);
    return `${weeks} sett.${days % 7 > 0 ? ` ${days % 7}g` : ""}`;
  }
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

function getTimingLabel(timing) {
  switch (timing) {
    case "bmo": return "Pre-Market";
    case "amc": return "After-Market";
    default: return "TBD";
  }
}

function getTimingClass(timing) {
  switch (timing) {
    case "bmo": return "timing-bmo";
    case "amc": return "timing-amc";
    default: return "timing-unknown";
  }
}

// ============================================================
// Date range helpers
// ============================================================

function isThisWeek(dateStr) {
  const today = new Date();
  const dayOfWeek = today.getDay();
  const startOfWeek = new Date(today);
  startOfWeek.setDate(today.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1));
  startOfWeek.setHours(0, 0, 0, 0);

  const endOfWeek = new Date(startOfWeek);
  endOfWeek.setDate(startOfWeek.getDate() + 6);
  endOfWeek.setHours(23, 59, 59, 999);

  const target = new Date(dateStr + "T12:00:00");
  return target >= startOfWeek && target <= endOfWeek;
}

function isNextWeek(dateStr) {
  const today = new Date();
  const dayOfWeek = today.getDay();
  const startOfNextWeek = new Date(today);
  startOfNextWeek.setDate(today.getDate() + (7 - (dayOfWeek === 0 ? 6 : dayOfWeek - 1)));
  startOfNextWeek.setHours(0, 0, 0, 0);

  const endOfNextWeek = new Date(startOfNextWeek);
  endOfNextWeek.setDate(startOfNextWeek.getDate() + 6);
  endOfNextWeek.setHours(23, 59, 59, 999);

  const target = new Date(dateStr + "T12:00:00");
  return target >= startOfNextWeek && target <= endOfNextWeek;
}

function isThisMonth(dateStr) {
  const today = new Date();
  const target = new Date(dateStr + "T12:00:00");
  return target.getMonth() === today.getMonth() && target.getFullYear() === today.getFullYear();
}

// ============================================================
// App state
// ============================================================

let currentView = "grid";
let currentFilter = "all";
let currentSort = "date-asc";
let searchQuery = "";
let stocks = [];

// ============================================================
// Data initialization
// ============================================================

function initData() {
  // Enrich data with computed fields
  stocks = TOP_40_STOCKS.map((stock, index) => ({
    ...stock,
    rank: index + 1,
    daysUntil: getDaysUntil(stock.earningsDate)
  }));
}

// ============================================================
// Filtering & Sorting
// ============================================================

function getFilteredStocks() {
  let filtered = [...stocks];

  // Text search
  if (searchQuery) {
    const q = searchQuery.toLowerCase();
    filtered = filtered.filter(
      (s) =>
        s.ticker.toLowerCase().includes(q) ||
        s.name.toLowerCase().includes(q) ||
        s.sector.toLowerCase().includes(q)
    );
  }

  // Category filter
  switch (currentFilter) {
    case "thisWeek":
      filtered = filtered.filter((s) => isThisWeek(s.earningsDate));
      break;
    case "nextWeek":
      filtered = filtered.filter((s) => isNextWeek(s.earningsDate));
      break;
    case "thisMonth":
      filtered = filtered.filter((s) => isThisMonth(s.earningsDate));
      break;
    case "bmo":
      filtered = filtered.filter((s) => s.timing === "bmo");
      break;
    case "amc":
      filtered = filtered.filter((s) => s.timing === "amc");
      break;
  }

  // Sorting
  switch (currentSort) {
    case "date-asc":
      filtered.sort((a, b) => a.daysUntil - b.daysUntil);
      break;
    case "date-desc":
      filtered.sort((a, b) => b.daysUntil - a.daysUntil);
      break;
    case "cap-desc":
      filtered.sort((a, b) => b.marketCap - a.marketCap);
      break;
    case "cap-asc":
      filtered.sort((a, b) => a.marketCap - b.marketCap);
      break;
    case "name-asc":
      filtered.sort((a, b) => a.name.localeCompare(b.name));
      break;
  }

  return filtered;
}

// ============================================================
// Rendering
// ============================================================

function renderGrid(data) {
  const container = document.getElementById("gridView");
  if (data.length === 0) {
    container.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--text-muted)">Nessun risultato trovato</div>`;
    return;
  }

  container.innerHTML = data
    .map(
      (s, i) => `
    <div class="card ${getUrgencyClass(s.daysUntil)}" style="--i:${i}">
      <div class="card-header">
        <span class="card-ticker">${s.ticker}</span>
        <span class="card-rank">#${s.rank}</span>
      </div>
      <div class="card-name">${s.name}</div>
      <span class="card-sector">${s.sector}</span>
      <div class="card-divider"></div>
      <div class="card-earnings">
        <span class="earnings-date">${formatDate(s.earningsDate)}</span>
        <span class="earnings-timing ${getTimingClass(s.timing)}">${getTimingLabel(s.timing)}</span>
      </div>
      <div class="card-meta">
        <span class="market-cap">${formatMarketCap(s.marketCap)}</span>
        <span class="countdown ${getCountdownClass(s.daysUntil)}">${getCountdownText(s.daysUntil)}</span>
      </div>
    </div>
  `
    )
    .join("");
}

function renderList(data) {
  const tbody = document.getElementById("listBody");
  if (data.length === 0) {
    tbody.innerHTML = `<tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted)">Nessun risultato trovato</td></tr>`;
    return;
  }

  tbody.innerHTML = data
    .map(
      (s) => `
    <tr>
      <td>${s.rank}</td>
      <td class="ticker-cell">${s.ticker}</td>
      <td>${s.name}</td>
      <td class="sector-cell">${s.sector}</td>
      <td class="cap-cell">${formatMarketCap(s.marketCap)}</td>
      <td class="date-cell">${formatDate(s.earningsDate)}</td>
      <td><span class="earnings-timing ${getTimingClass(s.timing)}">${getTimingLabel(s.timing)}</span></td>
      <td><span class="countdown ${getCountdownClass(s.daysUntil)}">${getCountdownText(s.daysUntil)}</span></td>
    </tr>
  `
    )
    .join("");
}

function renderStats() {
  const now = new Date();
  const in7 = stocks.filter((s) => s.daysUntil >= 0 && s.daysUntil <= 7).length;
  const in30 = stocks.filter((s) => s.daysUntil >= 0 && s.daysUntil <= 30).length;
  const thisW = stocks.filter((s) => isThisWeek(s.earningsDate)).length;

  document.getElementById("next7days").textContent = in7;
  document.getElementById("next30days").textContent = in30;
  document.getElementById("thisWeek").textContent = thisW;
  document.getElementById("lastUpdate").textContent = formatDateShort(
    now.toISOString().split("T")[0]
  );
}

function render() {
  const data = getFilteredStocks();
  const gridView = document.getElementById("gridView");
  const listView = document.getElementById("listView");

  if (currentView === "grid") {
    gridView.style.display = "grid";
    listView.style.display = "none";
    renderGrid(data);
  } else {
    gridView.style.display = "none";
    listView.style.display = "block";
    renderList(data);
  }

  renderStats();
}

// ============================================================
// Event listeners
// ============================================================

function setupEventListeners() {
  // View toggle
  document.getElementById("btnGrid").addEventListener("click", () => {
    currentView = "grid";
    document.getElementById("btnGrid").classList.add("active");
    document.getElementById("btnList").classList.remove("active");
    render();
  });

  document.getElementById("btnList").addEventListener("click", () => {
    currentView = "list";
    document.getElementById("btnList").classList.add("active");
    document.getElementById("btnGrid").classList.remove("active");
    render();
  });

  // Search
  document.getElementById("searchInput").addEventListener("input", (e) => {
    searchQuery = e.target.value;
    render();
  });

  // Filters
  document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      document.querySelectorAll(".filter-btn").forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");
      currentFilter = btn.dataset.filter;
      render();
    });
  });

  // Sort
  document.getElementById("sortSelect").addEventListener("change", (e) => {
    currentSort = e.target.value;
    render();
  });
}

// ============================================================
// Boot
// ============================================================

function boot() {
  const loading = document.getElementById("loading");
  const errorEl = document.getElementById("error");

  try {
    initData();
    setupEventListeners();

    // Simulate brief loading for smooth UX
    setTimeout(() => {
      loading.style.display = "none";
      render();
    }, 600);
  } catch (err) {
    loading.style.display = "none";
    errorEl.style.display = "flex";
    document.getElementById("errorMsg").textContent = err.message;
  }
}

document.addEventListener("DOMContentLoaded", boot);
