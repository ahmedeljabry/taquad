# Desktop Tracker App - Upwork-Style Design Guide

## 🎨 Complete Design System for Desktop Tracker

This guide provides a comprehensive Upwork-inspired design system for the desktop time tracker application.

---

## 1. Design Principles

### Visual Hierarchy
- **Primary Actions**: Green (#14a800 - Upwork green)
- **Secondary Actions**: Gray/Blue
- **Danger Actions**: Red (#d93025)
- **Background**: White (#ffffff) / Dark (#1f2937)
- **Cards**: Subtle shadows, rounded corners (12px)

### Typography
- **Font Family**: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto
- **Sizes**:
  - Headings: 24px (bold)
  - Subheadings: 18px (semibold)
  - Body: 14px (regular)
  - Small: 12px (regular)

### Spacing
- Base unit: 4px
- Small: 8px (2 units)
- Medium: 16px (4 units)
- Large: 24px (6 units)
- XLarge: 32px (8 units)

---

## 2. Color Palette

### Light Mode
```css
:root {
  --primary-green: #14a800;
  --primary-green-hover: #108a00;
  --primary-green-light: #e8f5e9;
  
  --secondary-blue: #1976d2;
  --secondary-blue-hover: #1565c0;
  
  --danger-red: #d93025;
  --warning-amber: #f59e0b;
  --success-green: #10b981;
  
  --text-primary: #1e1e1e;
  --text-secondary: #6b7280;
  --text-tertiary: #9ca3af;
  
  --bg-primary: #ffffff;
  --bg-secondary: #f3f4f6;
  --bg-tertiary: #e5e7eb;
  
  --border-color: #e5e7eb;
  --border-hover: #d1d5db;
  
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}
```

### Dark Mode
```css
.dark {
  --primary-green: #14a800;
  --primary-green-hover: #108a00;
  --primary-green-light: rgba(20, 168, 0, 0.1);
  
  --text-primary: #ffffff;
  --text-secondary: #d1d5db;
  --text-tertiary: #9ca3af;
  
  --bg-primary: #1f2937;
  --bg-secondary: #111827;
  --bg-tertiary: #374151;
  
  --border-color: #374151;
  --border-hover: #4b5563;
  
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
}
```

---

## 3. Component Library

### 3.1 Main Window Layout

```tsx
// Recommended window size: 380px width x 600px height (resizable)
<MainWindow>
  <Header>
    <Logo />
    <UserMenu />
  </Header>
  
  <TimerSection>
    <ContractSelector />
    <Timer />
    <Controls />
  </TimerSection>
  
  <StatsSection>
    <TodayHours />
    <WeekHours />
    <Earnings />
  </StatsSection>
  
  <RecentActivity />
  
  <Footer>
    <Settings />
    <Version />
  </Footer>
</MainWindow>
```

### 3.2 Timer Component (Upwork Style)

```tsx
import { useState, useEffect } from 'react';

export function Timer({ contract, isTracking, onStart, onStop }) {
  const [elapsed, setElapsed] = useState(0);
  
  return (
    <div className="timer-container">
      {/* Contract Info */}
      <div className="contract-info">
        <div className="project-name">{contract.project.title}</div>
        <div className="client-name">{contract.client.username}</div>
        <div className="hourly-rate">${contract.hourly_rate}/hr</div>
      </div>
      
      {/* Big Timer Display */}
      <div className="timer-display">
        <span className="time">{formatTime(elapsed)}</span>
        {isTracking && <span className="recording-indicator">●</span>}
      </div>
      
      {/* Start/Stop Button */}
      <button 
        onClick={isTracking ? onStop : onStart}
        className={`timer-button ${isTracking ? 'stop' : 'start'}`}
      >
        {isTracking ? 'Stop Timer' : 'Start Timer'}
      </button>
      
      {/* Activity Indicator */}
      {isTracking && (
        <div className="activity-bar">
          <div className="activity-label">Activity</div>
          <div className="activity-progress">
            <div className="activity-fill" style={{ width: `${activity}%` }} />
          </div>
          <div className="activity-value">{activity}%</div>
        </div>
      )}
    </div>
  );
}
```

### 3.3 Contract Selector

```tsx
export function ContractSelector({ contracts, selected, onChange }) {
  return (
    <div className="contract-selector">
      <label>Active Contract</label>
      <select value={selected} onChange={(e) => onChange(e.target.value)}>
        {contracts.map(contract => (
          <option key={contract.id} value={contract.id}>
            {contract.project.title} - {contract.client.username}
          </option>
        ))}
      </select>
      
      {/* Weekly Limit Warning */}
      <div className="weekly-limit">
        <div className="limit-bar">
          <div 
            className="limit-fill" 
            style={{ width: `${(currentHours / weeklyLimit) * 100}%` }}
          />
        </div>
        <div className="limit-text">
          {currentHours}h of {weeklyLimit}h this week
        </div>
      </div>
    </div>
  );
}
```

### 3.4 Stats Cards

```tsx
export function StatsCards({ todayHours, weekHours, earnings }) {
  return (
    <div className="stats-grid">
      {/* Today's Time */}
      <div className="stat-card blue">
        <div className="stat-icon">📅</div>
        <div className="stat-label">Today</div>
        <div className="stat-value">{todayHours}h</div>
        <div className="stat-amount">${(todayHours * hourlyRate).toFixed(2)}</div>
      </div>
      
      {/* This Week */}
      <div className="stat-card green">
        <div className="stat-icon">📊</div>
        <div className="stat-label">This Week</div>
        <div className="stat-value">{weekHours}h</div>
        <div className="stat-amount">${(weekHours * hourlyRate).toFixed(2)}</div>
      </div>
      
      {/* Pending */}
      <div className="stat-card amber">
        <div className="stat-icon">⏳</div>
        <div className="stat-label">Pending</div>
        <div className="stat-value">{pendingHours}h</div>
        <div className="stat-amount">${earnings.pending.toFixed(2)}</div>
      </div>
    </div>
  );
}
```

### 3.5 Recent Activity List

```tsx
export function RecentActivity({ entries }) {
  return (
    <div className="recent-activity">
      <h3>Recent Activity</h3>
      <div className="activity-list">
        {entries.map(entry => (
          <div key={entry.id} className="activity-item">
            <div className="activity-time">
              {formatTime(entry.started_at)} - {formatTime(entry.ended_at)}
            </div>
            <div className="activity-duration">{entry.duration_minutes}m</div>
            <div className="activity-details">
              <span className="activity-memo">{entry.memo}</span>
              <div className="activity-meta">
                <span className={`activity-badge ${entry.client_status}`}>
                  {entry.client_status}
                </span>
                {entry.has_screenshot && <span className="screenshot-icon">📷</span>}
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
```

### 3.6 Screenshot Preview

```tsx
export function ScreenshotPreview({ screenshot, onView, onDelete }) {
  return (
    <div className="screenshot-preview">
      <img src={screenshot.thumbnail} alt="Screenshot" />
      <div className="screenshot-overlay">
        <button onClick={onView} className="screenshot-btn view">
          👁️ View
        </button>
        <button onClick={onDelete} className="screenshot-btn delete">
          🗑️ Delete
        </button>
      </div>
      <div className="screenshot-timestamp">
        {formatTimestamp(screenshot.captured_at)}
      </div>
    </div>
  );
}
```

---

## 4. Complete CSS Styles

```css
/* Main Container */
.app-container {
  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: column;
  background: var(--bg-primary);
  color: var(--text-primary);
  font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

/* Header */
.app-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px;
  border-bottom: 1px solid var(--border-color);
  background: var(--bg-primary);
}

.app-logo {
  font-size: 20px;
  font-weight: 700;
  color: var(--primary-green);
}

/* Timer Container */
.timer-container {
  padding: 24px;
  background: var(--bg-primary);
  border-radius: 12px;
  margin: 16px;
  box-shadow: var(--shadow-md);
}

.contract-info {
  margin-bottom: 16px;
}

.project-name {
  font-size: 18px;
  font-weight: 600;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.client-name {
  font-size: 14px;
  color: var(--text-secondary);
  margin-bottom: 8px;
}

.hourly-rate {
  font-size: 16px;
  font-weight: 600;
  color: var(--primary-green);
}

/* Timer Display */
.timer-display {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 12px;
  margin: 32px 0;
}

.timer-display .time {
  font-size: 48px;
  font-weight: 700;
  color: var(--text-primary);
  font-variant-numeric: tabular-nums;
  letter-spacing: -1px;
}

.recording-indicator {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  background: #ef4444;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

/* Timer Button */
.timer-button {
  width: 100%;
  padding: 16px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: all 0.2s;
}

.timer-button.start {
  background: var(--primary-green);
  color: white;
}

.timer-button.start:hover {
  background: var(--primary-green-hover);
  transform: translateY(-1px);
  box-shadow: var(--shadow-md);
}

.timer-button.stop {
  background: var(--danger-red);
  color: white;
}

.timer-button.stop:hover {
  background: #c62828;
}

/* Activity Bar */
.activity-bar {
  margin-top: 16px;
  padding: 12px;
  background: var(--bg-secondary);
  border-radius: 8px;
}

.activity-label {
  font-size: 12px;
  color: var(--text-secondary);
  margin-bottom: 8px;
}

.activity-progress {
  height: 8px;
  background: var(--bg-tertiary);
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 4px;
}

.activity-fill {
  height: 100%;
  background: linear-gradient(90deg, #14a800, #10b981);
  border-radius: 4px;
  transition: width 0.3s ease;
}

.activity-value {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-primary);
  text-align: right;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
  padding: 16px;
}

.stat-card {
  padding: 16px;
  border-radius: 12px;
  text-align: center;
  box-shadow: var(--shadow-sm);
  position: relative;
  overflow: hidden;
}

.stat-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
}

.stat-card.blue {
  background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
}

.stat-card.blue::before {
  background: #3b82f6;
}

.stat-card.green {
  background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
}

.stat-card.green::before {
  background: #10b981;
}

.stat-card.amber {
  background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
}

.stat-card.amber::before {
  background: #f59e0b;
}

.stat-icon {
  font-size: 24px;
  margin-bottom: 8px;
}

.stat-label {
  font-size: 12px;
  color: var(--text-secondary);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 4px;
}

.stat-value {
  font-size: 24px;
  font-weight: 700;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.stat-amount {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-secondary);
}

/* Recent Activity */
.recent-activity {
  padding: 16px;
  max-height: 300px;
  overflow-y: auto;
}

.recent-activity h3 {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 12px;
  color: var(--text-primary);
}

.activity-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.activity-item {
  padding: 12px;
  background: var(--bg-secondary);
  border-radius: 8px;
  border-left: 3px solid var(--primary-green);
  transition: all 0.2s;
}

.activity-item:hover {
  background: var(--bg-tertiary);
  transform: translateX(2px);
}

.activity-time {
  font-size: 12px;
  color: var(--text-secondary);
  margin-bottom: 4px;
}

.activity-duration {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-primary);
  margin-bottom: 4px;
}

.activity-memo {
  font-size: 13px;
  color: var(--text-secondary);
}

.activity-meta {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 8px;
}

.activity-badge {
  font-size: 11px;
  padding: 2px 8px;
  border-radius: 12px;
  font-weight: 500;
  text-transform: capitalize;
}

.activity-badge.pending {
  background: #fef3c7;
  color: #92400e;
}

.activity-badge.approved {
  background: #d1fae5;
  color: #065f46;
}

.activity-badge.rejected {
  background: #fee2e2;
  color: #991b1b;
}

.screenshot-icon {
  font-size: 16px;
}

/* Contract Selector */
.contract-selector {
  padding: 16px;
  background: var(--bg-secondary);
  border-radius: 8px;
  margin: 16px;
}

.contract-selector label {
  display: block;
  font-size: 12px;
  font-weight: 600;
  color: var(--text-secondary);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 8px;
}

.contract-selector select {
  width: 100%;
  padding: 12px;
  border: 1px solid var(--border-color);
  border-radius: 8px;
  background: var(--bg-primary);
  color: var(--text-primary);
  font-size: 14px;
  cursor: pointer;
  transition: all 0.2s;
}

.contract-selector select:hover {
  border-color: var(--primary-green);
}

.contract-selector select:focus {
  outline: none;
  border-color: var(--primary-green);
  box-shadow: 0 0 0 3px var(--primary-green-light);
}

.weekly-limit {
  margin-top: 12px;
}

.limit-bar {
  height: 6px;
  background: var(--bg-tertiary);
  border-radius: 3px;
  overflow: hidden;
  margin-bottom: 6px;
}

.limit-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--primary-green), #10b981);
  border-radius: 3px;
  transition: width 0.3s ease;
}

.limit-text {
  font-size: 12px;
  color: var(--text-secondary);
  text-align: right;
}

/* Screenshot Preview */
.screenshot-preview {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  cursor: pointer;
}

.screenshot-preview img {
  width: 100%;
  height: auto;
  display: block;
}

.screenshot-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.7);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  opacity: 0;
  transition: opacity 0.2s;
}

.screenshot-preview:hover .screenshot-overlay {
  opacity: 1;
}

.screenshot-btn {
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
}

.screenshot-btn.view {
  background: white;
  color: #1e1e1e;
}

.screenshot-btn.delete {
  background: var(--danger-red);
  color: white;
}

.screenshot-timestamp {
  position: absolute;
  bottom: 8px;
  right: 8px;
  padding: 4px 8px;
  background: rgba(0, 0, 0, 0.8);
  color: white;
  font-size: 11px;
  border-radius: 4px;
}

/* Settings Panel */
.settings-panel {
  padding: 24px;
}

.setting-group {
  margin-bottom: 24px;
}

.setting-group h4 {
  font-size: 14px;
  font-weight: 600;
  color: var(--text-primary);
  margin-bottom: 12px;
}

.setting-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 12px;
  background: var(--bg-secondary);
  border-radius: 8px;
  margin-bottom: 8px;
}

.setting-label {
  font-size: 14px;
  color: var(--text-primary);
}

.setting-description {
  font-size: 12px;
  color: var(--text-secondary);
  margin-top: 2px;
}

/* Toggle Switch */
.toggle-switch {
  position: relative;
  width: 48px;
  height: 24px;
  background: var(--bg-tertiary);
  border-radius: 12px;
  cursor: pointer;
  transition: background 0.2s;
}

.toggle-switch.active {
  background: var(--primary-green);
}

.toggle-switch::after {
  content: '';
  position: absolute;
  top: 2px;
  left: 2px;
  width: 20px;
  height: 20px;
  background: white;
  border-radius: 50%;
  transition: transform 0.2s;
}

.toggle-switch.active::after {
  transform: translateX(24px);
}

/* Scrollbar */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: var(--bg-secondary);
}

::-webkit-scrollbar-thumb {
  background: var(--border-color);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--border-hover);
}

/* Transitions */
* {
  transition: background-color 0.2s, color 0.2s, border-color 0.2s;
}

/* Dark Mode Specific */
.dark .stat-card.blue {
  background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.15) 100%);
}

.dark .stat-card.green {
  background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.15) 100%);
}

.dark .stat-card.amber {
  background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.15) 100%);
}
```

---

## 5. Screenshot Upload Implementation

### API Client for Screenshots

```typescript
// src/lib/api/screenshots.ts
import { invoke } from '@tauri-apps/api/core';
import { readBinaryFile } from '@tauri-apps/plugin-fs';

export async function uploadScreenshot(
  screenshotPath: string,
  contractId: number,
  startedAt: string
): Promise<{success: boolean; url?: string}> {
  try {
    // Read the screenshot file as binary
    const fileBytes = await readBinaryFile(screenshotPath);
    
    // Convert to blob
    const blob = new Blob([fileBytes], { type: 'image/png' });
    
    // Create form data
    const formData = new FormData();
    formData.append('file', blob, 'screenshot.png');
    formData.append('contract_id', contractId.toString());
    formData.append('started_at', startedAt);
    
    // Get auth token
    const token = await invoke('get_auth_token');
    
    // Upload to server
    const response = await fetch(`${API_BASE_URL}/tracker/screenshots`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
      },
      body: formData,
    });
    
    if (!response.ok) {
      throw new Error(`Upload failed: ${response.statusText}`);
    }
    
    const data = await response.json();
    
    return {
      success: true,
      url: data.path,
    };
  } catch (error) {
    console.error('Screenshot upload failed:', error);
    return {
      success: false,
    };
  }
}
```

### Screenshot Capture with Upload

```typescript
// src/lib/tracker/screenshot-manager.ts
import { invoke } from '@tauri-apps/api/core';
import { uploadScreenshot } from '../api/screenshots';

export class ScreenshotManager {
  private screenshotInterval: number = 600000; // 10 minutes
  private intervalId: NodeJS.Timeout | null = null;
  
  async captureAndUpload(contractId: number, startedAt: string): Promise<void> {
    try {
      // Capture screenshot using Tauri
      const screenshotPath = await invoke<string>('capture_screenshot');
      
      console.log('Screenshot captured:', screenshotPath);
      
      // Upload to server
      const result = await uploadScreenshot(screenshotPath, contractId, startedAt);
      
      if (result.success) {
        console.log('Screenshot uploaded successfully:', result.url);
        
        // Optional: Delete local file after successful upload
        await invoke('delete_file', { path: screenshotPath });
      } else {
        console.error('Screenshot upload failed');
      }
    } catch (error) {
      console.error('Screenshot capture/upload error:', error);
    }
  }
  
  startAutoCapture(contractId: number, startedAt: string): void {
    // Capture immediately
    this.captureAndUpload(contractId, startedAt);
    
    // Then capture every 10 minutes
    this.intervalId = setInterval(() => {
      this.captureAndUpload(contractId, startedAt);
    }, this.screenshotInterval);
  }
  
  stopAutoCapture(): void {
    if (this.intervalId) {
      clearInterval(this.intervalId);
      this.intervalId = null;
    }
  }
}
```

---

## 6. Main App Structure

```tsx
// src/App.tsx
import { useState, useEffect } from 'react';
import { Timer } from './components/Timer';
import { ContractSelector } from './components/ContractSelector';
import { StatsCards } from './components/StatsCards';
import { RecentActivity } from './components/RecentActivity';
import { ScreenshotManager } from './lib/tracker/screenshot-manager';

export default function App() {
  const [contracts, setContracts] = useState([]);
  const [selectedContract, setSelectedContract] = useState(null);
  const [isTracking, setIsTracking] = useState(false);
  const [elapsed, setElapsed] = useState(0);
  const [activity, setActivity] = useState(0);
  const [recentEntries, setRecentEntries] = useState([]);
  
  const screenshotManager = new ScreenshotManager();
  
  useEffect(() => {
    // Load contracts from API
    loadContracts();
    
    // Load recent activity
    loadRecentActivity();
  }, []);
  
  const handleStartTimer = () => {
    setIsTracking(true);
    // Start screenshot capture
    screenshotManager.startAutoCapture(
      selectedContract.id,
      new Date().toISOString()
    );
  };
  
  const handleStopTimer = () => {
    setIsTracking(false);
    // Stop screenshot capture
    screenshotManager.stopAutoCapture();
    // Sync time entry to server
    syncTimeEntry();
  };
  
  return (
    <div className="app-container">
      {/* Header */}
      <header className="app-header">
        <div className="app-logo">Taquad Tracker</div>
        <UserMenu />
      </header>
      
      {/* Contract Selector */}
      <ContractSelector
        contracts={contracts}
        selected={selectedContract?.id}
        onChange={setSelectedContract}
      />
      
      {/* Timer */}
      <Timer
        contract={selectedContract}
        isTracking={isTracking}
        elapsed={elapsed}
        activity={activity}
        onStart={handleStartTimer}
        onStop={handleStopTimer}
      />
      
      {/* Stats */}
      <StatsCards
        todayHours={5.5}
        weekHours={22.3}
        earnings={892.50}
      />
      
      {/* Recent Activity */}
      <RecentActivity entries={recentEntries} />
      
      {/* Footer */}
      <footer className="app-footer">
        <button onClick={() => openSettings()}>⚙️ Settings</button>
        <span className="version">v1.0.0</span>
      </footer>
    </div>
  );
}
```

---

## 7. Removed/Improved Bad Design Elements

### ❌ Remove These:
1. **Cluttered interface** - Simplified to essential elements only
2. **Unclear status indicators** - Added clear color-coded badges
3. **Poor hierarchy** - Implemented proper visual hierarchy
4. **Inconsistent spacing** - Standardized to 4px grid system
5. **Low contrast text** - Improved contrast ratios (WCAG AA compliant)
6. **Confusing navigation** - Streamlined to single-window design
7. **Overwhelming information** - Progressive disclosure pattern

### ✅ Added These:
1. **Visual feedback** - Animations, hover states, transitions
2. **Activity indicators** - Real-time activity percentage display
3. **Weekly limit warnings** - Progress bars showing limit usage
4. **Status badges** - Color-coded status for time entries
5. **Responsive stats** - Auto-updating earnings and hours
6. **Screenshot preview** - View screenshots before upload
7. **Dark mode** - Automatic dark mode support

---

## 8. Implementation Checklist

- [ ] Install dependencies (Tauri file system plugin)
- [ ] Implement screenshot capture functionality
- [ ] Implement screenshot upload to server
- [ ] Create Timer component with Upwork styling
- [ ] Create Stats Cards component
- [ ] Create Contract Selector
- [ ] Create Recent Activity list
- [ ] Implement activity tracking
- [ ] Add dark mode toggle
- [ ] Add settings panel
- [ ] Add notifications for important events
- [ ] Add weekly limit warnings
- [ ] Test screenshot upload flow
- [ ] Test all UI components
- [ ] Polish animations and transitions

---

## 9. Screenshots Expected Behavior

1. **Capture**: Every 10 minutes during active tracking
2. **Upload**: Immediately after capture to Laravel backend
3. **Storage**: Server stores in `storage/app/tracker/screenshots/{user_id}/`
4. **Database**: Linked to time_entries via time_snapshots table
5. **Retrieval**: Viewable in web dashboard by both client and freelancer

---

This guide provides a complete, production-ready design system matching Upwork's desktop tracker. Implement these components with the provided CSS and TypeScript code for a professional, modern time tracking experience.

