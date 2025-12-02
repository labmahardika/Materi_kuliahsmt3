import matplotlib.pyplot as plt

# Fungsi untuk menghitung total jarak yang ditempuh oleh kepala disk
def calculate_distance(sequence):
    return sum(abs(sequence[i] - sequence[i - 1]) for i in range(1, len(sequence)))

# Algoritma First-Come, First-Serve (FCFS)
def fcfs(requests, start):
    sequence = [start] + requests
    return sequence, calculate_distance(sequence)

# Algoritma Shortest Seek Time First (SSTF)
def sstf(requests, start):
    sequence = [start]
    requests = requests[:]
    while requests:
        current = sequence[-1]
        next_request = min(requests, key=lambda x: abs(x - current))
        sequence.append(next_request)
        requests.remove(next_request)
    return sequence, calculate_distance(sequence)

# Algoritma SCAN
def scan(requests, start, end, direction="up"):
    sequence = [start]
    requests = sorted(requests)
    if direction == "up":
        sequence += [req for req in requests if req >= start] + [end] + [
            req for req in reversed(requests) if req < start
        ]
    else:
        sequence += [req for req in reversed(requests) if req <= start] + [0] + [
            req for req in requests if req > start
        ]
    return sequence, calculate_distance(sequence)

# Algoritma C-SCAN
def c_scan(requests, start, end):
    requests = sorted(requests)
    sequence = [start]
    sequence += [req for req in requests if req >= start] + [end, 0] + [
        req for req in requests if req < start
    ]
    return sequence, calculate_distance(sequence)

# Algoritma LOOK
def look(requests, start, direction="up"):
    sequence = [start]
    requests = sorted(requests)
    if direction == "up":
        sequence += [req for req in requests if req >= start] + [
            req for req in reversed(requests) if req < start
        ]
    else:
        sequence += [req for req in reversed(requests) if req <= start] + [
            req for req in requests if req > start
        ]
    return sequence, calculate_distance(sequence)

# Algoritma C-LOOK
def c_look(requests, start):
    requests = sorted(requests)
    sequence = [start]
    sequence += [req for req in requests if req >= start] + [
        req for req in requests if req < start
    ]
    return sequence, calculate_distance(sequence)

# Fungsi utama
def main():
    requests = [98, 183, 37, 122, 14, 124, 65, 67]
    start = 53
    end = 199

    algorithms = {
        "FCFS": fcfs,
        "SSTF": sstf,
        "SCAN (up)": lambda reqs, start: scan(reqs, start, end, "up"),
        "SCAN (down)": lambda reqs, start: scan(reqs, start, end, "down"),
        "C-SCAN": lambda reqs, start: c_scan(reqs, start, end),
        "LOOK (up)": lambda reqs, start: look(reqs, start, "up"),
        "LOOK (down)": lambda reqs, start: look(reqs, start, "down"),
        "C-LOOK": c_look,
}


    for name, algo in algorithms.items():
        sequence, distance = algo(requests, start)
        print(f"{name}:\nSequence: {sequence}\nTotal Distance: {distance}\n")
        # Visualisasi
        plt.plot(sequence, label=name, marker="o")

    plt.title("Disk Scheduling Algorithms")
    plt.xlabel("Request Sequence")
    plt.ylabel("Disk Position")
    plt.legend()
    plt.grid(True)
    plt.show()

if __name__ == "__main__":
    main()
