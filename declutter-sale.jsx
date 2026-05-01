import { useState, useEffect } from "react";

const WHATSAPP_NUMBER = "601116185660";

const CATEGORIES = ["Semua", "Perabot", "Elektronik", "Dapur", "Lain-lain"];

const ITEMS = [
  {
    id: 1,
    name: "Sofa L-Shape (IKEA)",
    price: 450,
    category: "Perabot",
    condition: "8/10",
    desc: "Warna kelabu, 2 tahun pakai. Masih cantik, tiada koyak.",
    emoji: "🛋️",
    color: "#D4A574",
  },
  {
    id: 2,
    name: "Meja Makan Kayu + 4 Kerusi",
    price: 380,
    category: "Perabot",
    condition: "7/10",
    desc: "Kayu oak solid. Ada minor scratches tapi structure very solid.",
    emoji: "🪑",
    color: "#8B7355",
  },
  {
    id: 3,
    name: "Samsung 43\" Smart TV",
    price: 600,
    category: "Elektronik",
    condition: "9/10",
    desc: "4K UHD, beli 2024. Siap wall mount bracket.",
    emoji: "📺",
    color: "#4A6FA5",
  },
  {
    id: 4,
    name: "Dyson V8 Vacuum",
    price: 350,
    category: "Elektronik",
    condition: "8/10",
    desc: "Battery masih tahan lama. Siap semua attachment.",
    emoji: "🧹",
    color: "#7B68AE",
  },
  {
    id: 5,
    name: "Rice Cooker Panasonic 1.8L",
    price: 80,
    category: "Dapur",
    condition: "9/10",
    desc: "Jarang guna, macam baru. Siap kotak.",
    emoji: "🍚",
    color: "#E07A5F",
  },
  {
    id: 6,
    name: "Air Fryer Philips XL",
    price: 150,
    category: "Dapur",
    condition: "8/10",
    desc: "Saiz XL, 6.2L. Goreng tanpa minyak!",
    emoji: "🍟",
    color: "#BC6C25",
  },
  {
    id: 7,
    name: "Rak Buku 5 Tier",
    price: 60,
    category: "Perabot",
    condition: "7/10",
    desc: "Warna putih, IKEA Billy. Self-pickup.",
    emoji: "📚",
    color: "#606C38",
  },
  {
    id: 8,
    name: "Standing Fan Panasonic",
    price: 45,
    category: "Elektronik",
    condition: "8/10",
    desc: "3 speed, timer function. Sejuk lagi.",
    emoji: "🌀",
    color: "#457B9D",
  },
  {
    id: 9,
    name: "Set Periuk Tefal (5 pcs)",
    price: 120,
    category: "Dapur",
    condition: "7/10",
    desc: "Non-stick masih okay. Siap penutup semua.",
    emoji: "🍳",
    color: "#E63946",
  },
  {
    id: 10,
    name: "Cermin Besar Berdiri",
    price: 70,
    category: "Lain-lain",
    condition: "9/10",
    desc: "Full length mirror, frame kayu. Cantik untuk bilik.",
    emoji: "🪞",
    color: "#CDB4DB",
  },
];

const fonts = `
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&display=swap');
`;

export default function DeclutterSale() {
  const [activeCategory, setActiveCategory] = useState("Semua");
  const [searchQuery, setSearchQuery] = useState("");
  const [loaded, setLoaded] = useState(false);
  const [hoveredId, setHoveredId] = useState(null);

  useEffect(() => {
    setTimeout(() => setLoaded(true), 100);
  }, []);

  const filtered = ITEMS.filter((item) => {
    const matchCategory =
      activeCategory === "Semua" || item.category === activeCategory;
    const matchSearch =
      item.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
      item.desc.toLowerCase().includes(searchQuery.toLowerCase());
    return matchCategory && matchSearch;
  });

  const handleWhatsApp = (item) => {
    const msg = encodeURIComponent(
      `Hai! Saya berminat dengan *${item.name}* (RM${item.price}) dari Moving Out Sale kamu. Masih available?`
    );
    window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${msg}`, "_blank");
  };

  return (
    <>
      <style>{fonts}</style>
      <div
        style={{
          minHeight: "100vh",
          background: "#F7F3EE",
          fontFamily: "'DM Sans', sans-serif",
          color: "#2C2C2C",
          overflowX: "hidden",
        }}
      >
        {/* Hero */}
        <div
          style={{
            background: "linear-gradient(160deg, #2C2C2C 0%, #1a1a2e 100%)",
            padding: "48px 20px 40px",
            textAlign: "center",
            position: "relative",
            overflow: "hidden",
          }}
        >
          <div
            style={{
              position: "absolute",
              top: 0,
              left: 0,
              right: 0,
              bottom: 0,
              background:
                "radial-gradient(circle at 20% 50%, rgba(212,165,116,0.15) 0%, transparent 50%), radial-gradient(circle at 80% 30%, rgba(74,111,165,0.1) 0%, transparent 50%)",
              pointerEvents: "none",
            }}
          />
          <div
            style={{
              opacity: loaded ? 1 : 0,
              transform: loaded ? "translateY(0)" : "translateY(20px)",
              transition: "all 0.8s cubic-bezier(0.16, 1, 0.3, 1)",
            }}
          >
            <div style={{ fontSize: "40px", marginBottom: "8px" }}>🏠</div>
            <h1
              style={{
                fontFamily: "'Playfair Display', serif",
                fontSize: "clamp(28px, 7vw, 42px)",
                fontWeight: 800,
                color: "#F7F3EE",
                margin: "0 0 8px",
                letterSpacing: "-0.5px",
                lineHeight: 1.1,
              }}
            >
              Moving Out Sale
            </h1>
            <p
              style={{
                color: "rgba(247,243,238,0.6)",
                fontSize: "15px",
                fontWeight: 300,
                margin: "0 0 4px",
                letterSpacing: "2px",
                textTransform: "uppercase",
              }}
            >
              Nak Pindah — Letgo Everything!
            </p>
            <p
              style={{
                color: "rgba(247,243,238,0.4)",
                fontSize: "13px",
                margin: "12px 0 0",
              }}
            >
              Tap WhatsApp untuk terus beli ✨
            </p>
          </div>
        </div>

        {/* Search */}
        <div style={{ padding: "20px 16px 0", maxWidth: 720, margin: "0 auto" }}>
          <div
            style={{
              position: "relative",
              opacity: loaded ? 1 : 0,
              transform: loaded ? "translateY(0)" : "translateY(10px)",
              transition: "all 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s",
            }}
          >
            <span
              style={{
                position: "absolute",
                left: 14,
                top: "50%",
                transform: "translateY(-50%)",
                fontSize: "18px",
                opacity: 0.4,
              }}
            >
              🔍
            </span>
            <input
              type="text"
              placeholder="Cari barang..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              style={{
                width: "100%",
                padding: "14px 16px 14px 44px",
                border: "2px solid #E8E2DA",
                borderRadius: 14,
                fontSize: 15,
                fontFamily: "'DM Sans', sans-serif",
                background: "#fff",
                outline: "none",
                boxSizing: "border-box",
                transition: "border-color 0.2s",
                color: "#2C2C2C",
              }}
              onFocus={(e) => (e.target.style.borderColor = "#D4A574")}
              onBlur={(e) => (e.target.style.borderColor = "#E8E2DA")}
            />
          </div>
        </div>

        {/* Categories */}
        <div
          style={{
            padding: "16px 16px 0",
            maxWidth: 720,
            margin: "0 auto",
            opacity: loaded ? 1 : 0,
            transform: loaded ? "translateY(0)" : "translateY(10px)",
            transition: "all 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.3s",
          }}
        >
          <div
            style={{
              display: "flex",
              gap: 8,
              overflowX: "auto",
              paddingBottom: 4,
              msOverflowStyle: "none",
              scrollbarWidth: "none",
            }}
          >
            {CATEGORIES.map((cat) => (
              <button
                key={cat}
                onClick={() => setActiveCategory(cat)}
                style={{
                  padding: "8px 18px",
                  border: "none",
                  borderRadius: 100,
                  fontSize: 13,
                  fontWeight: activeCategory === cat ? 600 : 400,
                  fontFamily: "'DM Sans', sans-serif",
                  background:
                    activeCategory === cat ? "#2C2C2C" : "rgba(0,0,0,0.05)",
                  color: activeCategory === cat ? "#F7F3EE" : "#666",
                  cursor: "pointer",
                  whiteSpace: "nowrap",
                  transition: "all 0.25s",
                  flexShrink: 0,
                }}
              >
                {cat}
              </button>
            ))}
          </div>
        </div>

        {/* Count */}
        <div
          style={{
            padding: "16px 16px 0",
            maxWidth: 720,
            margin: "0 auto",
          }}
        >
          <p style={{ fontSize: 13, color: "#999", margin: 0 }}>
            {filtered.length} barang dijumpai
          </p>
        </div>

        {/* Items Grid */}
        <div
          style={{
            padding: "12px 16px 40px",
            maxWidth: 720,
            margin: "0 auto",
            display: "grid",
            gridTemplateColumns: "repeat(auto-fill, minmax(min(100%, 300px), 1fr))",
            gap: 16,
          }}
        >
          {filtered.map((item, i) => (
            <div
              key={item.id}
              onMouseEnter={() => setHoveredId(item.id)}
              onMouseLeave={() => setHoveredId(null)}
              style={{
                background: "#fff",
                borderRadius: 18,
                overflow: "hidden",
                boxShadow:
                  hoveredId === item.id
                    ? "0 12px 40px rgba(0,0,0,0.12)"
                    : "0 2px 12px rgba(0,0,0,0.04)",
                transition: "all 0.35s cubic-bezier(0.16, 1, 0.3, 1)",
                transform: hoveredId === item.id ? "translateY(-4px)" : "translateY(0)",
                opacity: loaded ? 1 : 0,
                animation: loaded
                  ? `fadeSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) ${0.35 + i * 0.06}s both`
                  : "none",
              }}
            >
              {/* Emoji Banner */}
              <div
                style={{
                  background: `linear-gradient(135deg, ${item.color}22 0%, ${item.color}11 100%)`,
                  height: 110,
                  display: "flex",
                  alignItems: "center",
                  justifyContent: "center",
                  position: "relative",
                  borderBottom: `3px solid ${item.color}18`,
                }}
              >
                <span
                  style={{
                    fontSize: 52,
                    transition: "transform 0.3s",
                    transform:
                      hoveredId === item.id ? "scale(1.15) rotate(-5deg)" : "scale(1)",
                  }}
                >
                  {item.emoji}
                </span>
                <div
                  style={{
                    position: "absolute",
                    top: 10,
                    right: 10,
                    background: item.color,
                    color: "#fff",
                    fontSize: 11,
                    fontWeight: 600,
                    padding: "4px 10px",
                    borderRadius: 100,
                    letterSpacing: "0.3px",
                  }}
                >
                  {item.condition}
                </div>
                <div
                  style={{
                    position: "absolute",
                    top: 10,
                    left: 10,
                    background: "rgba(44,44,44,0.75)",
                    backdropFilter: "blur(8px)",
                    color: "#F7F3EE",
                    fontSize: 11,
                    fontWeight: 500,
                    padding: "4px 10px",
                    borderRadius: 100,
                  }}
                >
                  {item.category}
                </div>
              </div>

              {/* Content */}
              <div style={{ padding: "16px 18px 18px" }}>
                <h3
                  style={{
                    fontFamily: "'Playfair Display', serif",
                    fontSize: 17,
                    fontWeight: 700,
                    margin: "0 0 6px",
                    lineHeight: 1.25,
                    color: "#1a1a1a",
                  }}
                >
                  {item.name}
                </h3>
                <p
                  style={{
                    fontSize: 13,
                    color: "#888",
                    margin: "0 0 14px",
                    lineHeight: 1.5,
                  }}
                >
                  {item.desc}
                </p>

                <div
                  style={{
                    display: "flex",
                    alignItems: "center",
                    justifyContent: "space-between",
                    gap: 12,
                  }}
                >
                  <div
                    style={{
                      fontFamily: "'Playfair Display', serif",
                      fontSize: 22,
                      fontWeight: 800,
                      color: item.color,
                    }}
                  >
                    RM{item.price}
                  </div>
                  <button
                    onClick={() => handleWhatsApp(item)}
                    style={{
                      display: "flex",
                      alignItems: "center",
                      gap: 7,
                      padding: "10px 18px",
                      background: "#25D366",
                      color: "#fff",
                      border: "none",
                      borderRadius: 12,
                      fontSize: 13,
                      fontWeight: 600,
                      fontFamily: "'DM Sans', sans-serif",
                      cursor: "pointer",
                      transition: "all 0.2s",
                      boxShadow: "0 2px 8px rgba(37,211,102,0.25)",
                      flexShrink: 0,
                    }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.transform = "scale(1.05)";
                      e.currentTarget.style.boxShadow =
                        "0 4px 16px rgba(37,211,102,0.35)";
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.transform = "scale(1)";
                      e.currentTarget.style.boxShadow =
                        "0 2px 8px rgba(37,211,102,0.25)";
                    }}
                  >
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white">
                      <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    WhatsApp
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>

        {filtered.length === 0 && (
          <div
            style={{
              textAlign: "center",
              padding: "60px 20px",
              color: "#999",
            }}
          >
            <div style={{ fontSize: 40, marginBottom: 12 }}>🔍</div>
            <p style={{ fontSize: 15, margin: 0 }}>
              Takde barang dijumpai. Cuba cari lain?
            </p>
          </div>
        )}

        {/* Footer */}
        <div
          style={{
            textAlign: "center",
            padding: "24px 20px 32px",
            borderTop: "1px solid #E8E2DA",
          }}
        >
          <p style={{ fontSize: 12, color: "#aaa", margin: 0 }}>
            Self-pickup sahaja · COD area KL/Selangor · First come first serve
          </p>
        </div>

        <style>{`
          @keyframes fadeSlideUp {
            from {
              opacity: 0;
              transform: translateY(20px);
            }
            to {
              opacity: 1;
              transform: translateY(0);
            }
          }
          * { box-sizing: border-box; }
          ::-webkit-scrollbar { display: none; }
        `}</style>
      </div>
    </>
  );
}
