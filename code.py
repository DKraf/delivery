APPENDIX
import networkx as nx
import pandas as pd
import osmnx as ox
from IPython.display import IFrame
ox.config(log_console=True, use_cache=True)
ox.__version__
# get a graph for some city
G = ox.graph_from_address('Almaty, Kazakhstan', network_type='drive')
fig, ax = ox.plot_graph(G)
data1=pd.read_csv('supply_1.csv')
data2=pd.read_csv('demand_1.csv')
a = data1['Latitude']
b = data1['Longitude']
a1 = data2['Latitude']
b1 = data2['Longitude']
import numpy as np
orig_node= []
dest_node= []
c=[]
for i in range(5):
    for j in range(4):
        orig_node = ox.get_nearest_node(G, (a[i], b[i]))
        dest_node = ox.get_nearest_node(G, (a1[j],b1[j]))
        route = nx.shortest_path(G, orig_node, dest_node, weight='length')
        route1 =nx.shortest_path_length(G, orig_node, dest_node, weight='length')
        c.append(route1)

A=np.reshape(c, (4, 5))
print(A)
route = nx.shortest_path(G, orig_node, dest_node, weight='length')
fig, ax = ox.plot_graph_route(G, route, node_size=0)

#vogel method
TRUE, FALSE, N_ROWS, N_COLS = 1, 0, 4, 5

supply = [50, 60, 50, 50]
demand = [30, 20, 70, 30, 60]
costs = []
costs = A
# costs = [
# 	[16, 16, 13, 22, 17],
# 	[14, 14, 13, 19, 15],
# 	[19, 19, 20, 23, 50],
# 	[50, 12, 50, 15, 11]
# ]

row_done = [FALSE] * N_ROWS
col_done = [FALSE] * N_COLS

def diff(j, len, is_row, res):
	min1, min2, min_p = 1e9, 1e9, -1
	for i in range(len):
		ok = col_done[i] if is_row else row_done[i]
		if ok:
			continue
		c = costs[j][i] if is_row else costs[i][j]
		if c < min1:
			min2 = min1
			min1 = c
			min_p = i
		elif c < min2:
			min2 = c
	res[0], res[1], res[2] = min2 - min1, min1, min_p



def max_penalty(len1, len2, is_row, res):
	pc, pm, mc, md = -1, -1, -1, -1e9
	res2 = [0] * 4
	for i in range(len1):
		ok = row_done[i] if is_row else col_done[i]
		if ok:
			continue
		diff(i, len2, is_row, res2)
		if res2[0] > md:
			md = res2[0]
			pm = i
			mc = res2[1]
			pc = res2[2]

	if is_row:
		res[0], res[1] = pm, pc
	else:
		res[0], res[1] = pc, pm

	res[2], res[3] = mc, md



def next_cell(res):
	res1, res2 = [0] * 4, [0] * 4
	max_penalty(N_ROWS, N_COLS, TRUE, res1)
	max_penalty(N_COLS, N_ROWS, FALSE, res2)

	if res1[3] == res2[3]:
		if res1[2] < res2[2]:
			for i in range(4):
				res[i] = res1[i]
		else:
			for i in range(4):
				res[i] = res2[i]
		return None
	if res1[3] > res2[3]:
		for i in range(4):
			res[i] = res2[i]
	else:
		for i in range(4):
			res[i] = res1[i]

supply_left, total_cost = 0, 0
cell = [0] * 4
results = [[0] * N_COLS for _ in range(N_ROWS)]
opp = []
for i in range(N_ROWS):
    supply_left += supply[i]
while supply_left > 0:
	next_cell(cell)
	r = cell[0]
	c = cell[1]
	q = demand[c] if demand[c] <= supply[r] else supply[r]
	demand[c] -= q

	if not demand[c]:
		col_done[c] = TRUE
		supply[r] -= q

	if not supply[r]:
		row_done[r] = TRUE
	results[r][c] = q

	supply_left -= q
	total_cost += q * costs[r][c]

print('    A   B   C   D   E');
for i in range(N_ROWS):
	cur = chr(ord('W') + i)
	for j in range(N_COLS):
		cur += ' ' + str(results[i][j])

	print(cur)

#potential
from scipy.optimize import linprog

b= [50, 60, 50, 50]
c = [30, 20, 70, 30, 60]
res = linprog(c, A_ub=results, b_ub=b,
bounds=(0, None))
print('Optimal value:', res.fun, '\nX:', res.x)

