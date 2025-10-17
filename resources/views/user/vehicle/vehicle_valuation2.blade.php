<div style="display:grid;grid-template-columns:1fr 1.2fr 1fr;gap:20px;padding:20px;min-height:100vh;max-width:1600px;margin:0 auto;background:#0a0e27;color:#fff;font-family:Arial, sans-serif;">

    <!-- Left Panel -->
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:linear-gradient(135deg,#0066ff 0%,#1a7fff 100%);border:none;border-radius:12px;padding:20px;">
            <h2 style="font-size:12px;font-weight:700;letter-spacing:1px;margin-bottom:12px;">AUTOBOLI SUGGESTION</h2>
            <div style="display:flex;align-items:baseline;gap:12px;margin-bottom:16px;">
                <span style="font-size:32px;font-weight:700;">£14,000</span>
                <span style="font-size:12px;font-weight:600;padding:4px 8px;border-radius:4px;background:rgba(255,255,255,0.2);color:#10b981;">+5.6%</span>
                <span style="font-size:11px;opacity:0.8;">From last month</span>
            </div>
            <p style="font-size:13px;line-height:1.5;color:#fff;">Our price estimates use historical auction data and market trends to suggest likely values. <a href="#" style="color:#fff;text-decoration:underline;">learn more</a></p>
        </div>

        <div style="background:#111633;border:1px solid #2a3050;border-radius:12px;padding:20px;">
            <h3 style="font-size:14px;font-weight:600;margin-bottom:16px;">Vehicle Values</h3>

            <div style="margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid #2a3050;">
                <h4 style="font-size:13px;margin-bottom:8px;">Trad Values</h4>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div><span style="font-size:12px;color:#a0a9c9;">Autotrader</span><br><span style="font-size:18px;font-weight:700;">£14,000</span></div>
                    <div><span style="font-size:12px;color:#a0a9c9;">CAP</span><br><span style="font-size:18px;font-weight:700;">£14,000</span></div>
                </div>
            </div>

            <h4 style="font-size:13px;margin-bottom:8px;">Retail Values</h4>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                <div><span style="font-size:12px;color:#a0a9c9;">Autotrader</span><br><span style="font-size:18px;font-weight:700;">£14,000</span></div>
                <div><span style="font-size:12px;color:#a0a9c9;">CAP</span><br><span style="font-size:18px;font-weight:700;">£14,000</span></div>
            </div>
        </div>
    </div>

    <!-- Center Panel -->
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div style="background:#111633;border:1px solid #2a3050;border-radius:12px;padding:20px;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div>
                    <h3 style="font-size:18px;font-weight:700;">{{ $vehicle->reg ?? 'N/A' }}</h3>
                    <p style="font-size:12px;color:#a0a9c9;">
                        {{ $vehicle->make->name ?? 'Make' }} -
                        {{ $vehicle->model->name ?? 'Model' }} -
                        {{ $vehicle->variant->name ?? 'Variant' }} -
                        {{ $vehicle->engine_cc ?? 'CC' }} -
                        {{ $vehicle->year ?? 'Year' }}
                    </p>
                </div>
                <button style="background:#0066ff;color:#fff;border:none;padding:8px 16px;border-radius:6px;font-size:12px;font-weight:600;cursor:pointer;">New Report</button>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-top:10px;">
                <div><span style="font-size:11px;color:#a0a9c9;">Auction House</span><br><span>{{ $vehicle->auction->name ?? 'N/A' }}</span></div>
                <div><span style="font-size:11px;color:#a0a9c9;">Date Time / End</span><br><span>{{ $vehicle->auction->auction_date ? \Carbon\Carbon::parse($vehicle->auction->auction_date)->format('d/m/Y H:i') : 'N/A' }}</span></div>
                <div><span style="font-size:11px;color:#a0a9c9;">Auction Status</span><br><span>{{ $vehicle->bidding_status ?? 'Planned/Sold' }}</span></div>
            </div>

            <div style="width:100%;height:250px;background:#1a1f3a;border-radius:10px;margin-top:16px;display:flex;align-items:center;justify-content:center;">
                @php $mainImage = $vehicle->getImages()[0] ?? null; @endphp
                @if($mainImage)
                    <img src="{{ $mainImage }}" style="width:100%;height:250px;object-fit:cover;border-radius:10px;">
                @else
                    <span>No Image Available</span>
                @endif
            </div>
        </div>

        <!-- Trad History Card (Center bottom) -->
        <div style="background:#111633;border:1px solid #2a3050;border-radius:12px;padding:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                <h3 style="font-size:14px;">Trad History</h3>
                <select style="background:#1a1f3a;border:1px solid #2a3050;color:#a0a9c9;padding:8px 12px;border-radius:6px;font-size:12px;">
                    <option>Select range</option>
                    <option>Last 3 months</option>
                    <option>Last 6 months</option>
                    <option>Last year</option>
                </select>
            </div>
            <div>
                <div style="margin-bottom:16px;">
                    <span style="font-size:12px;color:#a0a9c9;">Avg Winning</span><br>
                    <span style="font-size:24px;font-weight:700;">£14,000</span>
                </div>
                <div style="height:200px;background:#1a1f3a;border-radius:8px;margin-bottom:16px;">
                    <canvas id="tradChart"></canvas>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                    <div><span style="display:inline-block;width:12px;height:12px;background:#0066ff;border-radius:2px;margin-right:6px;"></span>Autotrader</div>
                    <div><span style="display:inline-block;width:12px;height:12px;background:#10b981;border-radius:2px;margin-right:6px;"></span>CAP Clean</div>
                    <div><span style="display:inline-block;width:12px;height:12px;background:#0066ff;border-radius:2px;margin-right:6px;"></span>CAP Avg</div>
                    <div><span style="display:inline-block;width:12px;height:12px;background:#10b981;border-radius:2px;margin-right:6px;"></span>CAP B</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div style="display:flex;flex-direction:column;gap:20px;">
                <div style="background:#111633;border:1px solid #2a3050;border-radius:12px;padding:20px;">
                    <h3 style="font-size:14px;">Autoboli Predicted</h3>
                    <div style="display:flex;justify-content:space-between;margin-top:12px;">
                        <span style="font-size:12px;color:#a0a9c9;">Accuracy</span>
                        <span style="font-size:24px;font-weight:700;color:#0066ff;">90%</span>
                    </div>
                </div>

                <div style="display:flex;flex-direction:column;gap:12px;">
                    <div style="background:#1a1f3a;padding:12px;border-radius:6px;display:flex;justify-content:space-between;">
                        <span style="color:#a0a9c9;">CAP</span><span style="font-weight:700;">90%</span>
                    </div>
                    <div style="background:#1a1f3a;padding:12px;border-radius:6px;display:flex;justify-content:space-between;">
                        <span style="color:#a0a9c9;">AUTOTRADER</span><span style="font-weight:700;">90%</span>
                    </div>
                </div>

            <div style="background:#111633;border:1px solid #2a3050;border-radius:12px;padding:20px;">
                    <h3 style="font-size:14px;margin-bottom:10px;">Auction Results</h3>

                    <div style="display:flex;flex-direction:column;gap:8px;margin-bottom:12px;">
                        <div style="display:flex;justify-content:space-between;">
                            <span style="color:#a0a9c9;">Auction Status</span>
                            <span style="font-weight:600;">{{ $vehicle->bidding_status ?? 'N/A' }}</span>
                        </div>

                        <div style="display:flex;justify-content:space-between;">
                            <span style="color:#a0a9c9;">Win Bid / Last Bid</span>
                            <span style="font-weight:600;">£{{ $vehicle->last_bid ?? 'N/A' }}</span>
                        </div>

                        <div style="display:flex;justify-content:space-between;">
                            <span style="color:#a0a9c9;">No. of Bids</span>
                            <span style="font-weight:600;">
                                @php
                                    $bids = [];
                                    if (!empty($vehicle->bidding_history)) {
                                        $raw = $vehicle->bidding_history;

                                        // If it's in JSON or array-like string format, clean it up
                                        $raw = trim($raw, "[]");
                                        $raw = str_replace(["'", '"'], '', $raw); // remove quotes
                                        $bids = array_map('trim', explode(',', $raw)); // split by comma
                                    }
                                @endphp
                                            {{ count($bids) }}
                            </span>
                        </div>
               

                    {{-- Bid History --}}


                    <div style="margin-top:10px;">
                        <h4 style="font-size:13px;color:#a0a9c9;margin-bottom:6px;">Auc Bid History</h4>

                        @if(count($bids) > 0)
                            <p style="font-size:12px;color:#fff;line-height:1.6;">
                                {{ implode(', ', $bids) }}
                            </p>
                        @else
                            <p style="font-size:12px;color:#a0a9c9;">No bids found</p>
                        @endif
                    </div>

                </div>
        </div>


        <div style="background:#111633;border:1px solid #2a3050;border-radius:12px;padding:20px;">
            <h3 style="font-size:14px;margin-bottom:10px;">Pre Vehicles</h3>
            <div style="display:flex;flex-direction:column;gap:8px;">
                <div style="background:#1a1f3a;padding:10px;border-radius:6px;display:flex;justify-content:space-between;">
                    <span>ABC 123</span><span>£14,000</span>
                </div>
                <div style="background:#1a1f3a;padding:10px;border-radius:6px;display:flex;justify-content:space-between;">
                    <span>XYZ 456</span><span>£15,500</span>
                </div>
            </div>
        </div>
    </div>
</div>
